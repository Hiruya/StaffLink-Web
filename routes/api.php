<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\UserController;
use App\Models\User;





Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/api/grafik-promosi', [DashboardController::class, 'getGrafikPromosi']);

// Report API
Route::post('/report', [ReportController::class, 'store']);       // Untuk submit data report
Route::get('/report', [ReportController::class, 'getReportData']); // Untuk ambil data report



Route::middleware('auth:sanctum')->group(function () {
    Route::get('/absen', [AbsensiController::class, 'index'])->name('absensi.index');
});

Route::post('/absen', [AbsensiController::class, 'store']);
Route::get('/absen/check', [AbsenController::class, 'checkAbsen']);
Route::get('/users/last-login', function() {
    return \App\Models\User::select('id', 'name', 'updated_at')
        ->orderBy('updated_at', 'desc')
        ->get();
});


Route::post('/predict', [PromotionController::class, 'predict'])
    ->name('api.predict');
Route::get('/predict', [PromotionController::class, 'predict'])
    ->name('api.predict');
