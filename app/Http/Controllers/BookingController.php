<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Package;
use App\Models\Payment;
use App\Models\Promo;
use App\Models\Schedule;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $promoId = $request->query('promo_id');
        $promo = null;

        if ($promoId) {
            $promo = Promo::find($promoId);
        }

        $preselectedType = $request->query('type', 'photobooth');
        if (! in_array($preselectedType, ['photobooth', 'audio', 'bundle'], true)) {
            $preselectedType = 'photobooth';
        }

        $formConfig = config('booking-forms');

        $photoboothService = Service::where('slug', 'glad-moments')->first();
        if ($photoboothService && $photoboothService->packages->count() > 0) {
            $formConfig['photobooth_packages'] = $photoboothService->packages->mapWithKeys(function ($package) {
                return [$package->name => $package->discounted_price ?? $package->price];
            })->toArray();

            $formConfig['photobooth_package_meta'] = $photoboothService->packages->mapWithKeys(function ($package) {
                return [$package->name => $this->buildPackageMeta($package)];
            })->toArray();

            $formConfig['photobooth_package_details'] = $photoboothService->packages->mapWithKeys(function ($package) {
                $description = trim($package->description ?? '');
                $parts = $description === '' ? [] : preg_split('/\r?\n/', $description);
                return [$package->name => $parts ?: [$description ?: 'Detail paket belum tersedia.']];
            })->toArray();
        } else {
            $formConfig['photobooth_package_meta'] = $this->buildFallbackPackageMeta($formConfig['photobooth_packages']);
            $formConfig['photobooth_package_details'] = config('booking-forms.photobooth_package_details');
        }

        $audioService = Service::findBySlug('gladtocall');
        if ($audioService && $audioService->packages->count() > 0) {
            $formConfig['audio_packages'] = $audioService->packages->mapWithKeys(function ($package) {
                return [$package->name => $package->discounted_price ?? $package->price];
            })->toArray();

            $formConfig['audio_package_meta'] = $audioService->packages->mapWithKeys(function ($package) {
                return [$package->name => $this->buildPackageMeta($package)];
            })->toArray();

            $formConfig['audio_package_details'] = $audioService->packages->mapWithKeys(function ($package) {
                $description = trim($package->description ?? '');
                $parts = $description === '' ? [] : preg_split('/\r?\n/', $description);
                return [$package->name => $parts ?: [$description ?: 'Detail paket belum tersedia.']];
            })->toArray();
        } else {
            $formConfig['audio_package_meta'] = $this->buildFallbackPackageMeta($formConfig['audio_packages']);
            $formConfig['audio_package_details'] = config('booking-forms.audio_packages_details');
        }

        $bundleService = Service::where('slug', 'bundle')->first();
        if ($bundleService && $bundleService->packages->count() > 0) {
            $formConfig['bundle_packages'] = $bundleService->packages->mapWithKeys(function ($package) {
                return [$package->name => $package->discounted_price ?? $package->price];
            })->toArray();

            $formConfig['bundle_package_meta'] = $bundleService->packages->mapWithKeys(function ($package) {
                return [$package->name => $this->buildPackageMeta($package)];
            })->toArray();

            $formConfig['bundle_package_details'] = $bundleService->packages->mapWithKeys(function ($package) {
                $description = trim($package->description ?? '');
                $parts = $description === '' ? [] : preg_split('/\r?\n/', $description);
                return [$package->name => $parts ?: [$description ?: 'Detail paket belum tersedia.']];
            })->toArray();
        } else {
            $formConfig['bundle_package_meta'] = $this->buildFallbackPackageMeta($formConfig['bundle_packages']);
            $formConfig['bundle_package_details'] = config('booking-forms.bundle_package_details');
        }

        return view('pages.booking', [
            'preselectedType' => $preselectedType,
            'formConfig' => $formConfig,
            'downPaymentAmount' => config('booking.down_payment_amount'),
            'promo' => $promo,
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
            'package_id' => $this->resolvePackageId($type, $packageChoice),
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
        $photoboothService = Service::where('slug', 'glad-moments')->first();
        if ($photoboothService && $photoboothService->packages->count() > 0) {
            $packages = $photoboothService->packages->pluck('name')->toArray();
        } else {
            $packages = array_keys(config('booking-forms.photobooth_packages'));
        }

        $data = $request->validate([
            'booking_type' => 'required|in:photobooth',
            'promo_id' => 'nullable|exists:promos,id',
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
        $audioService = Service::findBySlug('gladtocall');
        if ($audioService && $audioService->packages->count() > 0) {
            $packages = $audioService->packages->pluck('name')->toArray();
        } else {
            $packages = array_keys(config('booking-forms.audio_packages'));
        }

        $data = $request->validate([
            'booking_type' => 'required|in:audio',
            'promo_id' => 'nullable|exists:promos,id',
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
        $bundleService = Service::where('slug', 'bundle')->first();
        if ($bundleService && $bundleService->packages->count() > 0) {
            $packages = $bundleService->packages->pluck('name')->toArray();
        } else {
            $packages = array_keys(config('booking-forms.bundle_packages'));
        }

        $data = $request->validate([
            'booking_type' => 'required|in:bundle',
            'promo_id' => 'nullable|exists:promos,id',
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
            'package_choice' => ['required', Rule::in($packages)],
        ]);

        $data['event_time'] = $data['event_start_time'];

        return $this->appendUpload($request, $data, 'signage');
    }

    private function buildPackageMeta($package): array
    {
        $originalPrice = (float) $package->price;
        $discountedPrice = $package->discounted_price !== null ? (float) $package->discounted_price : null;
        $hasDiscount = $discountedPrice !== null && $discountedPrice < $originalPrice;

        return [
            'price' => $originalPrice,
            'discounted_price' => $discountedPrice ?? $originalPrice,
            'promo_percent' => $package->promo_percent ? (int) $package->promo_percent : 0,
            'has_discount' => $hasDiscount,
            'savings' => $hasDiscount ? round($originalPrice - $discountedPrice, 2) : 0,
        ];
    }

    private function buildFallbackPackageMeta(array $packages): array
    {
        return collect($packages)->mapWithKeys(function ($price, $name) {
            $originalPrice = (float) $price;

            return [$name => [
                'price' => $originalPrice,
                'discounted_price' => $originalPrice,
                'promo_percent' => 0,
                'has_discount' => false,
                'savings' => 0,
            ]];
        })->toArray();
    }

    private function appendUpload(Request $request, array $data, string $field): array
    {
        if ($request->hasFile($field)) {
            $data[$field] = $request->file($field)->store('booking-uploads', 'public');
        }

        return $data;
    }

    private function resolvePackageId(string $type, ?string $packageChoice = null): int
    {
        if ($packageChoice) {
            $package = Package::where('name', $packageChoice)->first();
            if ($package) {
                return $package->id;
            }
        }

        $slug = match ($type) {
            'photobooth' => 'glad-moments',
            'audio' => 'gladtocall',
            'bundle' => 'bundle',
            default => 'glad-moments',
        };

        return Package::whereHas('service', fn ($q) => $q->whereIn('slug', Service::slugAliases($slug)))->value('id')
            ?? Package::query()->value('id');
    }

    private function ensureScheduleDateIsAvailable(string $eventDate): void
    {
        if (Schedule::whereDate('date', $eventDate)
            ->where(function ($query) {
                $query->whereRaw('LOWER(status) = ?', ['booked'])
                      ->orWhereRaw('LOWER(status) = ?', ['maintenance']);
            })
            ->exists()
        ) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'event_date' => 'Tanggal ' . date('d M Y', strtotime($eventDate)) . ' sudah terisi jadwal. Silakan pilih tanggal lain.',
            ]);
        }
    }

    private function resolvePrice(string $type, string $packageChoice): float
    {
        $package = Package::where('name', $packageChoice)->first();
        if ($package) {
            return $package->discounted_price ?? $package->price;
        }

        return match ($type) {
            'photobooth' => config("booking-forms.photobooth_packages.{$packageChoice}", 1500000),
            'audio' => config("booking-forms.audio_packages.{$packageChoice}", 2500000),
            'bundle' => config("booking-forms.bundle_packages.{$packageChoice}", 5800000),
            default => 1500000,
        };
    }
}