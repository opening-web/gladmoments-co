<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Package;
use App\Models\Payment;
use App\Models\Schedule;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $preselectedType = $request->query('type', 'photobooth');
        if (! in_array($preselectedType, ['photobooth', 'audio', 'bundle'], true)) {
            $preselectedType = 'photobooth';
        }

        $formConfig = config('booking-forms');

        // Fetch dynamic packages from database
        $photoboothService = Service::where('slug', 'gladmoments')->first();
        if ($photoboothService && $photoboothService->packages->count() > 0) {
            $formConfig['photobooth_packages'] = $photoboothService->packages->pluck('price', 'name')->toArray();
        }

        $audioService = Service::where('slug', 'gladtocall')->first();
        if ($audioService && $audioService->packages->count() > 0) {
            $formConfig['audio_packages'] = $audioService->packages->pluck('price', 'name')->toArray();
        }

        return view('pages.booking', [
            'preselectedType' => $preselectedType,
            'formConfig' => $formConfig,
            'downPaymentAmount' => config('booking.down_payment_amount'),
        ]);
    }

    public function store(Request $request)
    {
        $type = $request->input('booking_type');
        $validated = match ($type) {
            'photobooth' => $this->validatePhotobooth($request),
            'audio' => $this->validateAudio($request),
            'bundle' => $this->validateBundle($request),
            default => abort(422, 'Jenis booking tidak valid.'),
        };

        $packageChoice = $validated['package_choice'] ?? 'Bundle PhotoBooth + Audio Guestbook';
        $totalPrice = $this->resolvePrice($type, $packageChoice);
        $downPayment = min($totalPrice, config('booking.down_payment_amount'));

        $formDetails = collect($validated)
            ->except(['booking_type', 'package_choice', 'customer_name', 'customer_email', 'customer_phone', 'event_date', 'event_time', 'event_name', 'event_title'])
            ->all();

        $this->ensureScheduleDateIsAvailable($validated['event_date']);

        $booking = Booking::create([
            'package_id' => $this->resolvePackageId($type),
            'package_choice' => $packageChoice,
            'booking_type' => $type,
            'customer_name' => $validated['customer_name'] ?? $validated['recipient_name'] ?? '—',
            'customer_email' => $validated['customer_email'] ?? null,
            'customer_phone' => $validated['customer_phone'] ?? $validated['recipient_phone'] ?? '—',
            'event_date' => $validated['event_date'],
            'event_time' => $validated['event_time'] ?? $validated['event_start_time'] ?? '—',
            'event_name' => $validated['event_title'] ?? $validated['event_name'] ?? null,
            'event_location' => $validated['venue_maps'] ?? $validated['venue_address'] ?? null,
            'total_price' => $totalPrice,
            'down_payment' => $downPayment,
            'form_details' => $formDetails,
            'notes' => $validated['referral_source'] ?? null,
            'status' => 'pending',
        ]);

        return redirect()->route('booking.checkout', $booking);
    }

    public function checkout(Booking $booking)
    {
        $hasPayment = $booking->payments()->exists();
        if ($booking->status === 'pending' && $hasPayment) {
            return redirect()->route('booking.success', $booking);
        }

        return view('pages.checkout', [
            'booking' => $booking->load('package.service'),
            'downPayment' => $booking->down_payment,
            'bank' => config('booking.bank'),
        ]);
    }

    public function pay(Request $request, Booking $booking)
    {
        if ($booking->payments()->exists()) {
            return redirect()->route('booking.success', $booking);
        }

        $request->validate([
            'payment_proof' => 'required|image|max:5120',
        ]);

        $proofPath = $request->file('payment_proof')->store('payment-proofs', 'public');

        Payment::create([
            'booking_id' => $booking->id,
            'amount' => $booking->down_payment,
            'payment_method' => 'transfer',
            'payment_proof' => $proofPath,
            'status' => 'pending',
        ]);

        $booking->update(['status' => 'pending']);

        return redirect()->route('booking.success', $booking);
    }

    public function success(Booking $booking)
    {
        return view('pages.booking-success', [
            'booking' => $booking->load('package.service'),
        ]);
    }

    private function validatePhotobooth(Request $request): array
    {
        $photoboothService = Service::where('slug', 'gladmoments')->first();
        if ($photoboothService && $photoboothService->packages->count() > 0) {
            $packages = $photoboothService->packages->pluck('name')->toArray();
        } else {
            $packages = array_keys(config('booking-forms.photobooth_packages'));
        }

        $data = $request->validate([
            'booking_type' => 'required|in:photobooth',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'event_title' => 'required|string|max:255',
            'hashtag' => 'nullable|string|max:255',
            'venue_maps' => 'required|string|max:500',
            'event_date' => 'required|date|after_or_equal:today',
            'event_start_time' => 'required|string|max:10',
            'photobooth_start_time' => 'required|string|max:10',
            'pic_name' => 'required|string|max:255',
            'customer_phone' => ['required', 'regex:/^[0-9]+$/', 'max:20'],
            'package_choice' => ['required', Rule::in($packages)],
            'template_frame' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
            'backdrop' => 'nullable|string|max:255',
            'referral_source' => 'nullable|string|max:255',
            'referral_other' => 'nullable|string|max:255',
        ]);

        return $this->appendUpload($request, $data, 'template_frame');
    }

    private function validateAudio(Request $request): array
    {
        $audioService = Service::where('slug', 'gladtocall')->first();
        if ($audioService && $audioService->packages->count() > 0) {
            $packages = $audioService->packages->pluck('name')->toArray();
        } else {
            $packages = array_keys(config('booking-forms.audio_packages'));
        }

        $data = $request->validate([
            'booking_type' => 'required|in:audio',
            'recipient_name' => 'required|string|max:255',
            'recipient_phone' => ['required', 'regex:/^[0-9]+$/', 'max:20'],
            'customer_email' => 'required|email|max:255',
            'recipient_address' => 'nullable|string|max:500',
            'customer_name' => 'nullable|string|max:255',
            'event_title' => 'required|string|max:255',
            'venue_maps' => 'required|string|max:500',
            'event_date' => 'required|date|after_or_equal:today',
            'event_start_time' => 'required|string|max:10',
            'event_end_time' => 'required|string|max:10',
            'signage' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
            'pic_name' => 'required|string|max:255',
            'customer_phone' => ['required', 'regex:/^[0-9]+$/', 'max:20'],
            'package_choice' => ['required', Rule::in($packages)],
            'tablecloth' => ['required', Rule::in(config('booking-forms.tablecloth_options'))],
            'decor_theme' => 'nullable|string|max:255',
            'speaker_color' => 'nullable|string|max:50',
            'referral_source' => 'nullable|string|max:255',
            'referral_other' => 'nullable|string|max:255',
        ]);

        if (empty($data['customer_name'])) {
            $data['customer_name'] = $data['recipient_name'];
        }

        return $this->appendUpload($request, $data, 'signage');
    }

    private function validateBundle(Request $request): array
    {
        $data = $request->validate([
            'booking_type' => 'required|in:bundle',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'venue_maps' => 'required|string|max:500',
            'venue_address_2' => 'nullable|string|max:255',
            'venue_city' => 'nullable|string|max:100',
            'venue_state' => 'nullable|string|max:100',
            'venue_postal' => 'nullable|string|max:20',
            'event_title' => 'required|string|max:255',
            'event_date' => 'required|date|after_or_equal:today',
            'event_start_time' => 'required|string|max:10',
            'photobooth_start_time' => 'required|string|max:10',
            'photo_tone' => ['required', Rule::in(config('booking-forms.photo_tone'))],
            'print_size' => ['required', Rule::in(config('booking-forms.print_sizes'))],
            'guestbook_placement' => ['required', Rule::in(config('booking-forms.guestbook_placement'))],
            'backdrop' => ['required', Rule::in(config('booking-forms.backdrop_options'))],
            'tablecloth' => ['required', Rule::in(['Putih', 'Hitam'])],
            'decor_theme' => 'required|string|max:255',
            'signage' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
            'pic_name' => 'required|string|max:255',
            'customer_phone' => ['required', 'regex:/^[0-9]+$/', 'max:20'],
        ]);

        $data['package_choice'] = 'Bundle PhotoBooth + Audio Guestbook';
        $data['event_time'] = $data['event_start_time'];

        return $this->appendUpload($request, $data, 'signage');
    }

    private function appendUpload(Request $request, array $data, string $field): array
    {
        if ($request->hasFile($field)) {
            $data[$field] = $request->file($field)->store('booking-uploads', 'public');
        }

        return $data;
    }

    private function resolvePackageId(string $type, string $packageChoice = null): int
    {
        if ($packageChoice) {
            $package = Package::where('name', $packageChoice)->first();
            if ($package) {
                return $package->id;
            }
        }

        $slug = match ($type) {
            'photobooth' => 'gladmoments',
            'audio' => 'gladtocall',
            'bundle' => 'bundle',
            default => 'gladmoments',
        };

        return Package::whereHas('service', fn ($q) => $q->where('slug', $slug))->value('id')
            ?? Package::query()->value('id');
    }

    private function ensureScheduleDateIsAvailable(string $eventDate): void
    {
        if (Schedule::whereDate('date', $eventDate)->where('status', 'Booked')->exists()) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'event_date' => 'Tanggal ' . date('d M Y', strtotime($eventDate)) . ' sudah terisi jadwal. Silakan pilih tanggal lain.',
            ]);
        }
    }

    private function resolvePrice(string $type, string $packageChoice): float
    {
        $package = Package::where('name', $packageChoice)->first();
        if ($package) {
            return $package->price;
        }

        // Fallback
        return match ($type) {
            'photobooth' => config("booking-forms.photobooth_packages.{$packageChoice}", 1500000),
            'audio' => config("booking-forms.audio_packages.{$packageChoice}", 2500000),
            'bundle' => 5800000,
            default => 1500000,
        };
    }
}
