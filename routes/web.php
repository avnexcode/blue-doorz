<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use App\Http\Middleware\UserRolesMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.welcome');
})->name('page.welcome');

Route::middleware(['auth', 'verified', UserRolesMiddleware::class])->group(function() {
    Route::get('/dashboard', function () {return view('pages.dashboard.index');})->name('dashboard');
    Route::resource('dashboard/rooms', RoomController::class);
    Route::resource('dashboard/categories', CategoryController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
