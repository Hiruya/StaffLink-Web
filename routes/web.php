<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\LaporanHarianController;
use App\Models\LaporanHarian;




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


Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/grafik-promosi', [DashboardController::class, 'getGrafikPromosi']);

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
    Volt::route('/login', 'auth.login')->name('login');

Route::get('/absensi', [AbsensiController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('absensi.index');

Route::resource('laporanharian', LaporanHarianController::class)->middleware(['auth', 'verified']);

Route::get('/report-data', function () {
    $laporans = LaporanHarian::latest()->get();
    return response()->json($laporans);
});



Route::get('/absensi/download', [AbsensiController::class, 'downloadPDF'])->name('absensi.download');

    // Route untuk halaman View Absensi
Route::get('absensi/{id}', [AbsensiController::class, 'show'])->name('absensi.view');

// Route untuk halaman Edit Absensi
Route::get('absensi/{id}/edit', [AbsensiController::class, 'edit'])->name('absensi.edit');

// Tambahkan route untuk update data absensi jika Anda membutuhkan post data
Route::put('absensi/{id}', [AbsensiController::class, 'update'])->name('absensi.update');


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/penilaian', [PenilaianController::class, 'index'])->name('penilaian.index');
Route::post('/penilaian', [PenilaianController::class, 'store'])->name('penilaian.store');

Route::get('/penilaian/tampil', [PenilaianController::class, 'tampil'])->name('penilaian.tampil');

});



Route::get('/test-db', function() {
    try {
        DB::connection('mongodb')->getMongoClient()->listDatabases();
        return 'MongoDB connection successful!';
    } catch (\Exception $e) {
        return 'MongoDB connection failed: ' . $e->getMessage();
    }
});

// Route untuk prediksi promosi
Route::get('/promotion-predict', function () {return view('promotion.predict');})->name('promotion.predict');

Route::post('', [PromotionController::class, 'predict']);
Route::post('/api/predict-promotion', [PromotionController::class, 'predict'])
    ->name('api.predict-promotion');

require __DIR__.'/auth.php';