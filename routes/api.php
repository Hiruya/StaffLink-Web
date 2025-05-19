<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\LaporanHarianApiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PromotionController;



Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/laporan-harian', [LaporanHarianApiController::class, 'store']);
Route::get('/api/grafik-promosi', [DashboardController::class, 'getGrafikPromosi']);

// Report API
Route::post('/report', [ReportController::class, 'store']);       // Untuk submit data report
Route::get('/report', [ReportController::class, 'getReportData']); // Untuk ambil data report

Route::post('/absen/masuk', [AbsenController::class, 'masuk']);
Route::post('/absen/pulang', [AbsenController::class, 'pulang']);
Route::post('/absen/keterangan', [AbsenController::class, 'keterangan']);

Route::post('/predict', [PromotionController::class, 'predict'])
    ->name('api.predict');
Route::get('/predict', [PromotionController::class, 'predict'])
    ->name('api.predict');
