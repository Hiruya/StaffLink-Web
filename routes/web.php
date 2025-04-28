<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\DashboardController;




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

    Route::get('/absensi/download
    ', [AbsensiController::class, 'downloadPDF'])->name('absensi.download');

    // Route untuk halaman View Absensi
Route::get('absensi/{id}', [AbsensiController::class, 'show'])->name('absensi.view');

// Route untuk halaman Edit Absensi
Route::get('absensi/{id}/edit', [AbsensiController::class, 'edit'])->name('absensi.edit');

// Tambahkan route untuk update data absensi jika Anda membutuhkan post data
Route::put('absensi/{id}', [AbsensiController::class, 'update'])->name('absensi.update');


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

});

// Route untuk jadwal
Route::resource('jadwal', JadwalController::class);
Route::post('/jadwal/bulk-delete', [JadwalController::class, 'bulkDelete'])->name('jadwal.bulkDelete');

require __DIR__.'/auth.php';
