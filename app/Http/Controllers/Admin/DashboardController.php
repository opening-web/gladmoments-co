<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Booking;
use App\Models\Service;

class DashboardController extends Controller
{
    public function index()
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login')->withErrors(['login_error' => 'Akses ditolak. Silakan login terlebih dahulu!']);
        }

        $totalBookings = Booking::count();
        $totalRevenue = Booking::whereIn('status', ['approved', 'completed'])->sum('total_price');
        $activeServicesCount = Service::count();

        return view('admin.index', compact('totalBookings', 'totalRevenue', 'activeServicesCount'));
    }
}