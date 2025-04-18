<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\JadwalController;



Route::get('/', function () {
    return view('landing');
})->name('home');

Route::get('/service', function () {
    return view('service');
})->name('service');

Route::get('/starter', function () {
    return view('starter');
})->name('starter');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
    Volt::route('/login', 'auth.login')->name('login');

Route::get('/absensi', [AbsensiController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('absensi.index');

Route::get('/jadwal', [JadwalController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('jadwal.index');



});

require __DIR__.'/auth.php';
