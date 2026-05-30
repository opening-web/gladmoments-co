<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Service;

class AdminPackageController extends Controller
{
    public function index()
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login')->withErrors(['login_error' => 'Akses ditolak.']);
        }

        $services = Service::with('packages')->orderBy('name')->get();
        return view('admin.packages.index', compact('services'));
    }

    public function show($id)
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login')->withErrors(['login_error' => 'Akses ditolak.']);
        }

        $package = Package::with('service')->findOrFail($id);
        return view('admin.packages.show', compact('package'));
    }

    public function create()
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login')->withErrors(['login_error' => 'Akses ditolak.']);
        }

        $services = Service::all();
        $selectedServiceId = request()->query('service_id');

        return view('admin.packages.create', compact('services', 'selectedServiceId'));
    }

    public function store(Request $request)
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login')->withErrors(['login_error' => 'Akses ditolak.']);
        }

        $request->validate([
            'service_id' => 'required|exists:services,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'promo_percent' => 'nullable|numeric|min:0|max:100',
            'description' => 'required|string',
        ]);

        Package::create($request->only(['service_id', 'name', 'description', 'price', 'promo_percent']));

        return redirect()->route('admin.packages.index')->with('success', 'Paket berhasil ditambahkan!');
    }

    public function edit($id)
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login')->withErrors(['login_error' => 'Akses ditolak.']);
        }

        $package = Package::findOrFail($id);
        $services = Service::all();
        return view('admin.packages.edit', compact('package', 'services'));
    }

    public function update(Request $request, $id)
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login')->withErrors(['login_error' => 'Akses ditolak.']);
        }

        $request->validate([
            'service_id' => 'required|exists:services,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'promo_percent' => 'nullable|numeric|min:0|max:100',
            'description' => 'required|string',
        ]);

        $package = Package::findOrFail($id);
        $package->update($request->only(['service_id', 'name', 'description', 'price', 'promo_percent']));

        return redirect()->route('admin.packages.index')->with('success', 'Paket berhasil diperbarui!');
    }

    public function destroy($id)
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login')->withErrors(['login_error' => 'Akses ditolak.']);
        }

        $package = Package::findOrFail($id);
        $package->delete();

        return redirect()->route('admin.packages.index')->with('success', 'Paket berhasil dihapus!');
    }
}
