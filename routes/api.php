<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\LaporanHarianApiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;



Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/laporan-harian', [LaporanHarianApiController::class, 'store']);
Route::get('/api/grafik-promosi', [DashboardController::class, 'getGrafikPromosi']);

// Report API
Route::post('/report', [ReportController::class, 'store']);       // Untuk submit data report
Route::get('/report', [ReportController::class, 'getReportData']); // Untuk ambil data report