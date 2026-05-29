<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class AdminTestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::latest()->get();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'event' => 'nullable|string|max:255',
            'message' => 'required|string',
            'rating' => 'nullable|integer|min:1|max:5',
            'is_active' => 'nullable|boolean',
        ]);

        try {
            Testimonial::create([
                'name' => $data['name'],
                'event' => $data['event'] ?? null,
                'message' => $data['message'],
                'rating' => $data['rating'] ?? 5,
                'is_active' => $request->boolean('is_active', true),
            ]);
        } catch (\Throwable $e) {
            report($e);
            return back()->withErrors(['save_error' => $e->getMessage()])->withInput();
        }

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil ditambahkan.');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'event' => 'nullable|string|max:255',
            'message' => 'required|string',
            'rating' => 'nullable|integer|min:1|max:5',
            'is_active' => 'nullable|boolean',
        ]);

        $testimonial->update([
            'name' => $data['name'],
            'event' => $data['event'] ?? null,
            'message' => $data['message'],
            'rating' => $data['rating'] ?? 5,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil diperbarui.');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil dihapus.');
    }
}

