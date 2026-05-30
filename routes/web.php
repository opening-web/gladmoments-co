<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PortfolioPageController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminServiceController;
use App\Http\Controllers\Admin\AdminBookingController;
use App\Http\Controllers\Admin\AdminScheduleController;
use App\Http\Controllers\Admin\AdminPortfolioController;
use App\Http\Controllers\Admin\AdminHighlightController;
use App\Http\Controllers\Admin\AdminPromoController;
use App\Http\Controllers\Admin\AdminTestimonialController;

use App\Http\Controllers\Admin\AdminPackageController;

Route::get('/storage/{path}', function ($path) {
    $disk = Storage::disk('public');

    if (! $disk->exists($path)) {
        abort(404);
    }

    return response()->file($disk->path($path));
})->where('path', '.*');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/services/{slug}', [ServiceController::class, 'show'])->name('services.show');
Route::get('/portfolio', [PortfolioPageController::class, 'index'])->name('portfolio');
Route::get('/contact', function () { return view('pages.contact'); })->name('contact');

Route::get('/booking', [BookingController::class, 'index'])->name('booking.index');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
Route::get('/booking/{booking}/checkout', [BookingController::class, 'checkout'])->name('booking.checkout');
Route::post('/booking/{booking}/pay', [BookingController::class, 'pay'])->name('booking.pay');
Route::get('/booking/{booking}/success', [BookingController::class, 'success'])->name('booking.success');

Route::get('/dashboard', function () { return view('pages.dashboard'); })->name('dashboard');
Route::get('/api/schedules', [HomeController::class, 'schedulesApi'])->name('api.schedules');

Route::prefix('admin')->as('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');
    
    Route::middleware('admin.auth')->group(function () {
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        Route::resource('services', AdminServiceController::class);
        Route::resource('packages', AdminPackageController::class);
        Route::resource('schedules', AdminScheduleController::class);
        Route::resource('portfolios', AdminPortfolioController::class);
        Route::resource('highlights', AdminHighlightController::class);
        Route::resource('promos', AdminPromoController::class);
        Route::resource('testimonials', AdminTestimonialController::class);
        
        Route::get('/bookings/new-count', [AdminBookingController::class, 'newBookingsCount'])->name('bookings.new_count');
        Route::get('/bookings', [AdminBookingController::class, 'index'])->name('bookings.index');
        Route::post('/bookings/{id}/approve', [AdminBookingController::class, 'approve'])->name('bookings.approve');
        Route::post('/bookings/{id}/reject', [AdminBookingController::class, 'reject'])->name('bookings.reject');
        Route::post('/bookings/{id}/upload-proof', [AdminBookingController::class, 'uploadProof'])->name('bookings.upload_proof');
    });
});