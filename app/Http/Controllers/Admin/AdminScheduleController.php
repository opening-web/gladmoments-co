<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Service;

class AdminScheduleController extends Controller
{
    public function index()
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login')->withErrors(['login_error' => 'Akses ditolak.']);
        }

        $schedules = Schedule::with('service')->latest()->get();
        return view('admin.schedules.index', compact('schedules'));
    }

    public function create()
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login')->withErrors(['login_error' => 'Akses ditolak.']);
        }

        $services = Service::all();
        return view('admin.schedules.create', compact('services'));
    }

    public function store(Request $request)
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login')->withErrors(['login_error' => 'Akses ditolak.']);
        }

        $request->validate([
            'service_id' => 'required|exists:services,id',
            'date' => 'required|date',
            'time' => 'required',
            'location' => 'required|string',
            'status' => 'required|in:Available,Booked,Maintenance',
        ]);

        Schedule::create($request->all());

        return redirect()->route('admin.schedules.index')->with('success', 'Jadwal berhasil ditambahkan!');
    }

    public function edit($id)
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login')->withErrors(['login_error' => 'Akses ditolak.']);
        }

        $schedule = Schedule::findOrFail($id);
        $services = Service::all();
        return view('admin.schedules.edit', compact('schedule', 'services'));
    }

    public function show($id)
    {
        return redirect()->route('admin.schedules.edit', $id);
    }

    public function update(Request $request, $id)
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login')->withErrors(['login_error' => 'Akses ditolak.']);
        }

        $request->validate([
            'service_id' => 'required|exists:services,id',
            'date' => 'required|date',
            'time' => 'required',
            'location' => 'required|string',
            'status' => 'required|in:Available,Booked,Maintenance',
        ]);

        $schedule = Schedule::findOrFail($id);
        $schedule->update($request->all());

        return redirect()->route('admin.schedules.index')->with('success', 'Jadwal berhasil diperbarui!');
    }

    public function destroy($id)
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login')->withErrors(['login_error' => 'Akses ditolak.']);
        }

        $schedule = Schedule::findOrFail($id);
        $schedule->delete();

        return redirect()->route('admin.schedules.index')->with('success', 'Jadwal berhasil dihapus!');
    }
}