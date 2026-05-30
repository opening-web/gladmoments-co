<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class AdminPromoController extends Controller
{
    public function index()
    {
        $promos = Promo::latest()->get();
        return view('admin.promos.index', compact('promos'));
    }

    public function create()
    {
        return view('admin.promos.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:10240',
            'cta_url' => 'required_if:is_active,1|string|max:255',
            'cta_target' => 'nullable|in:_self,_blank',
            'priority' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $path = $request->file('image')->store('promos', 'public');

        $payload = [
            'title' => $data['title'],
            'cta_url' => $data['cta_url'] ?? null,
            'cta_target' => $data['cta_target'] ?? '_self',
            'priority' => $data['priority'] ?? 0,
            'is_active' => $request->boolean('is_active', true),
        ];

        if (Schema::hasColumn('promos', 'image_path')) {
            $payload['image_path'] = $path;
        }

        if (Schema::hasColumn('promos', 'banner_image')) {
            $payload['banner_image'] = $path;
        }

        try {
            Promo::create($payload);
        } catch (\Throwable $e) {
            report($e);
            return back()->withErrors(['save_error' => $e->getMessage()])->withInput();
        }

        return redirect()->route('admin.promos.index')->with('success', 'Promo berhasil ditambahkan.');
    }

    public function show(Promo $promo)
    {
        return redirect()->route('admin.promos.index');
    }

    public function edit(Promo $promo)
    {
        return view('admin.promos.edit', compact('promo'));
    }

    public function update(Request $request, Promo $promo)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
            'cta_url' => 'required_if:is_active,1|string|max:255',
            'cta_target' => 'nullable|in:_self,_blank',
            'priority' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            $oldFiles = array_filter([$promo->image_path, $promo->banner_image]);
            if (!empty($oldFiles)) {
                Storage::disk('public')->delete($oldFiles);
            }
            $stored = $request->file('image')->store('promos', 'public');
            if (Schema::hasColumn('promos', 'image_path')) {
                $promo->image_path = $stored;
            }
            if (Schema::hasColumn('promos', 'banner_image')) {
                $promo->banner_image = $stored;
            }
        }

        $promo->title = $data['title'];
        $promo->cta_url = $data['cta_url'] ?? null;
        $promo->cta_target = $data['cta_target'] ?? '_self';
        $promo->priority = $data['priority'] ?? 0;
        $promo->is_active = $request->boolean('is_active', true);
        $promo->save();

        return redirect()->route('admin.promos.index')->with('success', 'Promo berhasil diperbarui.');
    }

    public function destroy(Promo $promo)
    {
        $files = array_filter([$promo->image_path, $promo->banner_image]);
        if (!empty($files)) {
            Storage::disk('public')->delete($files);
        }

        $promo->delete();

        return redirect()->route('admin.promos.index')->with('success', 'Promo berhasil dihapus.');
    }
}
