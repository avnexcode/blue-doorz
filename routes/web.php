<?php

use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RentController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;
use App\Http\Middleware\UserRolesMiddleware;

Route::get('/', [HomeController::class, 'index'])->name('pages.home');

Route::middleware(['auth', 'verified', UserRolesMiddleware::class])->group(function () {
    Route::get('/dashboard', function () {
        return view('pages.dashboard.index', [
            "title" => "Dashboard"
        ]);
    })->name('dashboard');
    Route::resource('dashboard/rooms', RoomController::class);
    Route::resource('dashboard/categories', CategoryController::class);
    Route::resource('dashboard/transactions', TransactionController::class);
    Route::resource('dashboard/reports', ReportController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/{id}/booking', [BookingController::class, 'index'])->name('booking');
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
});

require __DIR__ . '/auth.php';
