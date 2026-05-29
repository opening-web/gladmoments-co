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
            $popupPromo = (object) [
                'title' => $popupPromo->title,
                'caption' => $popupPromo->caption ?? ($popupPromo->subtitle ?? null),
                'image_path' => $imagePath,
                'image_url' => $imagePath ? '/storage/' . ltrim($imagePath, '/') : null,
                'cta_text' => $popupPromo->cta_text ?? ($popupPromo->button_text ?? 'Lihat Promo'),
                'cta_url' => $popupPromo->cta_url ?? ($popupPromo->url ?? '#'),
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
            $date = \Carbon\Carbon::parse($schedule->date);
            $monthIndex = (int) $date->format('n'); // 1..12
            $day = (int) $date->format('j');
            $slug = $schedule->service->slug;

            if (! isset($bookedCalendar[$slug])) {
                $bookedCalendar[$slug] = [];
            }
            if (! isset($bookedCalendar[$slug][$monthIndex])) {
                $bookedCalendar[$slug][$monthIndex] = [];
            }
            if (! in_array($day, $bookedCalendar[$slug][$monthIndex], true)
                && in_array($schedule->status, ['Booked', 'Maintenance'], true)
            ) {
                $bookedCalendar[$slug][$monthIndex][] = $day;
            }
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
            $date = \Carbon\Carbon::parse($schedule->date);
            $monthIndex = (int) $date->format('n'); // 1..12
            $day = (int) $date->format('j');
            $slug = $schedule->service->slug;

            if (! isset($bookedCalendar[$slug])) {
                $bookedCalendar[$slug] = [];
            }
            if (! isset($bookedCalendar[$slug][$monthIndex])) {
                $bookedCalendar[$slug][$monthIndex] = [];
            }
            if (! in_array($day, $bookedCalendar[$slug][$monthIndex], true)
                && in_array($schedule->status, ['Booked', 'Maintenance'], true)
            ) {
                $bookedCalendar[$slug][$monthIndex][] = $day;
            }
        }

        return response()->json($bookedCalendar);
    }
}
