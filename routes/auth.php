<?php

use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\Admin\AssignUserRoleController;
use App\Http\Controllers\Karyawan\KaryawanController;
use App\Http\Controllers\Hrd\HrdController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

// User routes
Route::prefix('users')->group(function () {
    Route::get('/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/{user}', [UserController::class, 'update'])->name('users.update');
    Route::put('/{user}/reset-password', [UserController::class, 'resetPassword'])->name('users.reset-password');
    Route::delete('/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('assign-role', [AssignUserRoleController::class, 'index'])->name('assign-role.index');
    Route::put('assign-role/{user}', [AssignUserRoleController::class, 'update'])->name('assign-role.update');
});

// Route::middleware(['auth', 'role:karyawan'])->prefix('karyawan')->name('karyawan.')->group(function () {
//     Route::get('/', [KaryawanController::class, 'index'])->name('index');
//     Route::get('/create', [KaryawanController::class, 'create'])->name('create');
//     Route::post('/', [KaryawanController::class, 'store'])->name('store');
// });

// Add this to your routes/auth.php file
Route::middleware(['auth', 'role:hrd'])->prefix('hrd')->name('hrd.')->group(function () {
    Route::get('/', [HrdController::class, 'index'])->name('index');
    Route::get('/{id}', [HrdController::class, 'show'])->name('show');
});

// Update your existing karyawan routes group to include:
Route::middleware(['auth', 'role:karyawan'])->prefix('karyawan')->name('karyawan.')->group(function () {
    Route::get('/', [KaryawanController::class, 'index'])->name('index');
    Route::get('/create', [KaryawanController::class, 'create'])->name('create');
    Route::post('/', [KaryawanController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [KaryawanController::class, 'edit'])->name('edit');
    Route::put('/{id}', [KaryawanController::class, 'update'])->name('update');
});

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
