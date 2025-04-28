<?php

use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\JadwalController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

// Route untuk user yang belum login (guest)
Route::middleware('guest')->group(function () {
    Volt::route('login', 'auth.login')->name('login');
    Volt::route('register', 'auth.register')->name('register');
    Volt::route('forgot-password', 'auth.forgot-password')->name('password.request');
    Volt::route('reset-password/{token}', 'auth.reset-password')->name('password.reset');
});

// Route untuk user yang sudah login (auth)
Route::middleware('auth')->group(function () {
    Volt::route('verify-email', 'auth.verify-email')->name('verification.notice');
    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');
    Volt::route('confirm-password', 'auth.confirm-password')->name('password.confirm');

    // Route untuk jadwal
    Route::resource('jadwal', JadwalController::class);
    Route::post('/jadwal/bulk-delete', [JadwalController::class, 'bulkDelete'])->name('jadwal.bulk-delete');
});

// Route logout
Route::post('logout', App\Livewire\Actions\Logout::class)->name('logout');