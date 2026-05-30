<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Schedule;
use App\Models\Portfolio;
use App\Models\Highlight;
use App\Models\Promo;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index()
    {
        $services = Service::all()->keyBy('slug');

        $portfolios = Portfolio::latest()->take(12)->get();
        $highlights = Highlight::where('is_active', true)->latest()->get();
        $popupPromo = Promo::where('is_active', true)
            ->orderByDesc('priority')
            ->latest()
            ->first();

        // Normalize promo fields to a predictable shape for the view
        if ($popupPromo) {
            $imagePath = $popupPromo->image_path ?? ($popupPromo->banner_image ?? null);
            $bookingUrl = $popupPromo->cta_url ?: route('booking.index', ['promo_id' => $popupPromo->id]);
            $popupPromo = (object) [
                'id' => $popupPromo->id,
                'title' => $popupPromo->title,
                'caption' => $popupPromo->caption ?? ($popupPromo->subtitle ?? null),
                'image_path' => $imagePath,
                'image_url' => $imagePath ? '/storage/' . ltrim($imagePath, '/') : null,
                'cta_text' => $popupPromo->cta_text ?? ($popupPromo->button_text ?? 'Booking Sekarang'),
                'cta_url' => $bookingUrl,
                'cta_target' => $popupPromo->cta_target ?? '_self',
                'priority' => $popupPromo->priority ?? 0,
            ];
        }
        $testimonials = Testimonial::where('is_active', true)->latest()->take(3)->get();

        $schedules = Schedule::with('service')->get();
        $bookedCalendar = [];
        foreach ($schedules as $schedule) {
            if (! $schedule->service || ! $schedule->date) {
                continue;
            }

            $status = strtolower(trim($schedule->status ?? ''));
            if (! in_array($status, ['booked', 'maintenance'], true)) {
                continue;
            }

            $date = \Carbon\Carbon::parse($schedule->date);
            $monthIndex = (int) $date->format('n'); // 1..12
            $day = (int) $date->format('j');
            $slug = $schedule->service->slug;
            $calendarKey = str_replace('-', '', $slug);

            if (! isset($bookedCalendar[$calendarKey])) {
                $bookedCalendar[$calendarKey] = [];
            }
            if (! isset($bookedCalendar[$calendarKey][$monthIndex])) {
                $bookedCalendar[$calendarKey][$monthIndex] = [];
            }
            $bookedCalendar[$calendarKey][$monthIndex][$day] = $status;
        }

        return view('pages.home', [
            'services' => $services,
            'portfolios' => $portfolios,
            'highlights' => $highlights,
            'popupPromo' => $popupPromo,
            'testimonials' => $testimonials,
            'bookedCalendar' => $bookedCalendar,
        ]);
    }

    public function schedulesApi()
    {
        $schedules = \App\Models\Schedule::with('service')->get();
        $bookedCalendar = [];
        foreach ($schedules as $schedule) {
            if (! $schedule->service || ! $schedule->date) {
                continue;
            }

            $status = strtolower(trim($schedule->status ?? ''));
            if (! in_array($status, ['booked', 'maintenance'], true)) {
                continue;
            }

            $date = \Carbon\Carbon::parse($schedule->date);
            $monthIndex = (int) $date->format('n'); // 1..12
            $day = (int) $date->format('j');
            $slug = $schedule->service->slug;
            $calendarKey = str_replace('-', '', $slug);

            if (! isset($bookedCalendar[$calendarKey])) {
                $bookedCalendar[$calendarKey] = [];
            }
            if (! isset($bookedCalendar[$calendarKey][$monthIndex])) {
                $bookedCalendar[$calendarKey][$monthIndex] = [];
            }
            $bookedCalendar[$calendarKey][$monthIndex][$day] = $status;
        }

        return response()->json($bookedCalendar);
    }
}
