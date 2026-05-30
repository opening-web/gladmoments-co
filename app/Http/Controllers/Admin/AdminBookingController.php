<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Schedule;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;

class AdminBookingController extends Controller
{
    public function index(Request $request)
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login')->withErrors(['login_error' => 'Akses ditolak.']);
        }

        $status = $request->get('status');
        $search = $request->get('search');

        $bookings = Booking::with([
                'package',
                'payments' => fn ($q) => $q->latest('id'),
            ])
            ->when($status, fn($q) => $q->where('status', $status))
            ->when($search, function ($query) use ($search) {
                return $query->where('customer_name', 'like', "%{$search}%")
                             ->orWhere('customer_phone', 'like', "%{$search}%");
            })
            ->latest()
            ->get();

        $stats = [
            'pending' => Booking::where('status', 'pending')->count(),
            'approved' => Booking::where('status', 'approved')->count(),
            'rejected' => Booking::where('status', 'rejected')->count(),
            'total' => Booking::count(),
        ];

        return view('admin.bookings.index', compact('bookings', 'status', 'search', 'stats'));
    }

    public function approve($id)
    {
        $booking = Booking::findOrFail($id);

        $conflict = Schedule::whereDate('date', $booking->event_date)
            ->where('status', 'Booked')
            ->exists();

        if ($conflict) {
            return redirect()->route('admin.bookings.index')
                ->withErrors(['booking' => 'Tanggal ' . $booking->event_date->format('d M Y') . ' sudah terisi jadwal.']);
        }

        $booking->update(['status' => 'approved']);

        $serviceIds = $this->resolveBookingScheduleServiceIds($booking);
        foreach ($serviceIds as $serviceId) {
            Schedule::create([
                'service_id' => $serviceId,
                'date' => $booking->event_date,
                'time' => $booking->event_time,
                'location' => $booking->event_location,
                'status' => 'Booked',
            ]);
        }

        return redirect()->route('admin.bookings.index')->with('success', 'Pesanan disetujui dan jadwal otomatis dibuat!');
    }

    private function resolveBookingScheduleServiceIds(Booking $booking): array
    {
        if ($booking->booking_type === 'bundle') {
            return Service::whereIn('slug', array_merge(Service::slugAliases('gladtocall'), ['gladmoments']))->pluck('id')->filter()->values()->all();
        }

        if ($booking->package && $booking->package->service_id) {
            return [$booking->package->service_id];
        }

        $slugMap = [
            'photobooth' => 'gladmoments',
            'audio' => 'gladtocall',
        ];

        $slug = $slugMap[$booking->booking_type] ?? 'gladmoments';
        $serviceId = Service::idBySlug($slug);

        return $serviceId ? [$serviceId] : [];
    }

    public function reject($id)
    {
        Booking::findOrFail($id)->update([
            'status' => 'rejected',
        ]);
        return redirect()->route('admin.bookings.index')->with('success', 'Pesanan ditolak.');
    }

    public function uploadProof(Request $request, $id)
    {
        $request->validate(['payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048']);
        $booking = Booking::findOrFail($id);

        if ($request->hasFile('payment_proof')) {
            $latestPayment = $booking->payments()->latest('id')->first();
            if ($latestPayment?->payment_proof && Storage::disk('public')->exists($latestPayment->payment_proof)) {
                Storage::disk('public')->delete($latestPayment->payment_proof);
            }

            $path = $request->file('payment_proof')->store('proofs', 'public');
            Payment::updateOrCreate(
                ['booking_id' => $booking->id, 'status' => 'pending'],
                [
                    'amount' => $booking->down_payment,
                    'payment_method' => 'transfer',
                    'payment_proof' => $path,
                ]
            );
        }
        return redirect()->route('admin.bookings.index')->with('success', 'Bukti berhasil diunggah!');
    }

    public function newBookingsCount()
    {
        if (!session()->has('admin_logged_in')) {
            return response()->json(['error' => 'Akses ditolak.'], 403);
        }
        $count = Booking::where('status', 'pending')->count();
        return response()->json(['count' => $count]);
    }
}