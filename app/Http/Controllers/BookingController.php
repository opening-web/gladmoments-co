<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Promo;
use App\Models\Package;
use App\Models\Service;

class BookingController extends Controller
{
    public function create(Request $request)
    {
        $promo = null;
        if ($request->has('promo_code')) {
            $promo = Promo::where('code', $request->promo_code)
                ->where('is_active', true)
                ->first();
        }

        $audioService = Service::where('name', 'like', '%Audio%')->first();
        $serviceId = $audioService ? $audioService->id : 3;

        $packages = Package::where('service_id', $serviceId)->get();

        $audioPackages = [];
        $audioPackageDetails = [];
        $audioPackageMeta = [];

        foreach ($packages as $package) {
            $originalPrice = $package->price;
            $finalPrice = $originalPrice;
            $hasDiscount = false;
            $promoPercent = 0;
            $savings = 0;

            if ($promo) {
                if ($promo->type === 'percentage') {
                    $promoPercent = $promo->value;
                    $savings = ($originalPrice * $promoPercent) / 100;
                    $finalPrice = $originalPrice - $savings;
                    $hasDiscount = true;
                } elseif ($promo->type === 'fixed') {
                    $savings = $promo->value;
                    $finalPrice = max(0, $originalPrice - $savings);
                    $promoPercent = $originalPrice > 0 ? round(($savings / $originalPrice) * 100) : 0;
                    $hasDiscount = true;
                }
            }

            $audioPackages[$package->id] = $finalPrice;

            $audioPackageDetails[$package->id] = [
                'name' => $package->name,
                'points' => explode("\n", $package->description)
            ];

            $audioPackageMeta[$package->id] = [
                'price' => $originalPrice,
                'has_discount' => $hasDiscount,
                'promo_percent' => $promoPercent,
                'savings' => $savings
            ];
        }

        $formConfig = [
            'audio_packages' => $audioPackages,
            'audio_package_details' => $audioPackageDetails,
            'audio_package_meta' => $audioPackageMeta,
            'tablecloth_options' => ['Putih Polos', 'Maron', 'Renda Klasik', 'Tanpa Taplak'],
            'speaker_options' => ['Hitam Klasik', 'Rose Gold', 'Putih Minimalis'],
            'referral_sources' => ['Instagram', 'TikTok', 'Bridestory', 'Teman/Keluarga', 'Lainnya']
        ];

        $downPaymentAmount = 500000;
        $preselectedType = 'audio';

        return view('booking', compact('formConfig', 'promo', 'downPaymentAmount', 'preselectedType'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'booking_type' => 'required|string',
            'recipient_name' => 'required|string|max:255',
            'recipient_phone' => 'required|string|max:20',
            'customer_email' => 'required|email|max:255',
            'recipient_address' => 'nullable|string',
            'customer_name' => 'nullable|string|max:255',
            'event_title' => 'required|string|max:255',
            'venue_maps' => 'required|string',
            'event_date' => 'required|date|after_or_equal:today',
            'event_start_time' => 'required',
            'event_end_time' => 'required',
            'signage' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'pic_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'package_choice' => 'required|exists:packages,id',
            'tablecloth' => 'required|string',
            'decor_theme' => 'nullable|string|max:255',
            'speaker_color' => 'nullable|string|max:255',
            'referral_source' => 'nullable|string|max:255',
            'referral_other' => 'nullable|string|max:255',
            'promo_id' => 'nullable|exists:promos,id',
        ]);

        $package = Package::findOrFail($request->package_choice);
        $originalPrice = $package->price;
        $finalPrice = $originalPrice;

        if ($request->filled('promo_id')) {
            $promo = Promo::find($request->promo_id);
            if ($promo && $promo->is_active) {
                if ($promo->type === 'percentage') {
                    $finalPrice = $originalPrice - (($originalPrice * $promo->value) / 100);
                } elseif ($promo->type === 'fixed') {
                    $finalPrice = max(0, $originalPrice - $promo->value);
                }
            }
        }

        $booking = new Booking();
        $booking->booking_type = $request->booking_type;
        $booking->recipient_name = $request->recipient_name;
        $booking->recipient_phone = $request->recipient_phone;
        $booking->customer_email = $request->customer_email;
        $booking->recipient_address = $request->recipient_address;
        $booking->customer_name = $request->customer_name ?? $request->recipient_name;
        $booking->event_title = $request->event_title;
        $booking->venue_maps = $request->venue_maps;
        $booking->event_date = $request->event_date;
        $booking->event_start_time = $request->event_start_time;
        $booking->event_end_time = $request->event_end_time;
        
        if ($request->hasFile('signage')) {
            $path = $request->file('signage')->store('signages', 'public');
            $booking->signage = $path;
        }

        $booking->pic_name = $request->pic_name;
        $booking->customer_phone = $request->customer_phone;
        $booking->package_id = $package->id;
        $booking->package_name = $package->name;
        $booking->total_price = $finalPrice;
        $booking->tablecloth = $request->tablecloth;
        $booking->decor_theme = $request->decor_theme;
        $booking->speaker_color = $request->speaker_color;
        
        if ($request->referral_source === 'Lainnya') {
            $booking->referral_source = $request->referral_other;
        } else {
            $booking->referral_source = $request->referral_source;
        }

        $booking->promo_id = $request->promo_id;
        $booking->payment_status = 'pending';
        $booking->save();

        return redirect()->route('payment.checkout', ['booking' => $booking->id]);
    }
}