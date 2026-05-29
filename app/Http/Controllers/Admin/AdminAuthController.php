<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    // Akun admin default yang langsung bisa dipakai (tanpa register)
    private $default_username = 'admin';
    private $default_password = 'admin123';

    // Menampilkan halaman login
    public function showLoginForm()
    {
        // Jika admin sudah login sebelumnya, langsung lempar ke dashboard
        if (session()->has('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    // Memproses data login
    public function login(Request $request)
    {
        // Validasi input wajib diisi
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Cek apakah input cocok dengan akun default
        if ($request->username === $this->default_username && $request->password === $this->default_password) {
            // Simpan status login ke dalam session komputer
            session(['admin_logged_in' => true, 'admin_name' => 'Default Admin']);
            
            return redirect()->route('admin.dashboard');
        }

        // Cek ke database table admins
        $admin = \Illuminate\Support\Facades\DB::table('admins')->where('email', $request->username)->first();
        if ($admin) {
            if (\Illuminate\Support\Facades\Hash::check($request->password, $admin->password) || $request->password === $admin->password) {
                session(['admin_logged_in' => true, 'admin_name' => $admin->name]);
                return redirect()->route('admin.dashboard');
            }
        }

        // Jika salah, kembali ke halaman login dengan pesan error
        return back()->withErrors(['login_error' => 'Username atau Password salah!'])->withInput();
    }

    // Memproses logout
    public function logout()
    {
        session()->forget('admin_logged_in');
        return redirect()->route('admin.login');
    }
}