<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookingForm;
use App\Models\Service;
use Illuminate\Http\Request;

class AdminBookingFormController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!session()->has('admin_logged_in')) {
                return redirect()->route('admin.login')->withErrors(['login_error' => 'Akses ditolak.']);
            }
            return $next($request);
        });
    }

    public function index()
    {
        $forms = BookingForm::with('service', 'fields')->get();
        return view('admin.booking-forms.index', compact('forms'));
    }

    public function show(BookingForm $bookingForm)
    {
        $bookingForm->load('service', 'fields');
        return view('admin.booking-forms.show', compact('bookingForm'));
    }

    public function edit(BookingForm $bookingForm)
    {
        $bookingForm->load('service', 'fields');
        $services = Service::all();
        return view('admin.booking-forms.edit', compact('bookingForm', 'services'));
    }

    public function update(Request $request, BookingForm $bookingForm)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $bookingForm->update($validated);

        return redirect()
            ->route('admin.booking-forms.show', $bookingForm)
            ->with('success', 'Booking form updated successfully!');
    }
}
