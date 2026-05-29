<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminServiceController extends Controller
{
    public function index()
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login')->withErrors(['login_error' => 'Akses ditolak. Silakan login terlebih dahulu!']);
        }

        $services = Service::latest()->get();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login')->withErrors(['login_error' => 'Akses ditolak. Silakan login terlebih dahulu!']);
        }

        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login')->withErrors(['login_error' => 'Akses ditolak. Silakan login terlebih dahulu!']);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'badge_label' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:5120',
        ]);

        $data = $request->only(['name', 'price', 'description', 'badge_label']);
        $data['slug'] = Str::slug($request->name);

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('service-images', 'public');
        }

        Service::create($data);

        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil ditambahkan!');
    }

    public function show($id)
    {
        return redirect()->route('admin.services.index');
    }

    public function edit($id)
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login')->withErrors(['login_error' => 'Akses ditolak. Silakan login terlebih dahulu!']);
        }

        $service = Service::findOrFail($id);
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login')->withErrors(['login_error' => 'Akses ditolak. Silakan login terlebih dahulu!']);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'badge_label' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:5120',
        ]);

        $service = Service::findOrFail($id);

        $data = $request->only(['name', 'price', 'description', 'badge_label']);
        $data['slug'] = Str::slug($request->name);

        if ($request->hasFile('image')) {
            if ($service->image_path && Storage::disk('public')->exists($service->image_path)) {
                Storage::disk('public')->delete($service->image_path);
            }
            $data['image_path'] = $request->file('image')->store('service-images', 'public');
        }

        $service->update($data);

        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login')->withErrors(['login_error' => 'Akses ditolak. Silakan login terlebih dahulu!']);
        }

        $service = Service::findOrFail($id);
        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil dihapus!');
    }
}