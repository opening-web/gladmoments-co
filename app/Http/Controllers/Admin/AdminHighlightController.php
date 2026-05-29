<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Highlight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminHighlightController extends Controller
{
    public function index()
    {
        $highlights = Highlight::latest()->get();
        return view('admin.highlights.index', compact('highlights'));
    }

    public function create()
    {
        return view('admin.highlights.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|in:wedding,photobooth,birthday,brand',
            'caption' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:10240',
            'is_active' => 'nullable|boolean',
        ]);

        $path = $request->file('image')->store('highlights', 'public');

        try {
            Highlight::create([
                'title' => $data['title'],
                'category' => $data['category'] ?? null,
                'caption' => $data['caption'] ?? null,
                'image_path' => $path,
                'is_active' => $request->boolean('is_active', true),
            ]);
        } catch (\Throwable $e) {
            report($e);
            return back()->withErrors(['save_error' => $e->getMessage()])->withInput();
        }

        return redirect()->route('admin.highlights.index')->with('success', 'Highlight berhasil ditambahkan.');
    }

    public function edit(Highlight $highlight)
    {
        return view('admin.highlights.edit', compact('highlight'));
    }

    public function show(Highlight $highlight)
    {
        return redirect()->route('admin.highlights.index');
    }

    public function update(Request $request, Highlight $highlight)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|in:wedding,photobooth,birthday,brand',
            'caption' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($highlight->image_path) {
                Storage::disk('public')->delete($highlight->image_path);
            }
            $highlight->image_path = $request->file('image')->store('highlights', 'public');
        }

        $highlight->title = $data['title'];
        $highlight->category = $data['category'] ?? null;
        $highlight->caption = $data['caption'] ?? null;
        $highlight->is_active = $request->boolean('is_active', true);
        $highlight->save();

        return redirect()->route('admin.highlights.index')->with('success', 'Highlight berhasil diperbarui.');
    }

    public function destroy(Highlight $highlight)
    {
        if ($highlight->image_path) {
            Storage::disk('public')->delete($highlight->image_path);
        }

        $highlight->delete();

        return redirect()->route('admin.highlights.index')->with('success', 'Highlight berhasil dihapus.');
    }
}

