<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();  // Dapatkan tanggal hari ini

        // Hitung jumlah absensi hari ini berdasarkan kolom 'tanggal'
        $jumlahHariIni = Absensi::whereDate('tanggal', $today)->count();

        // Pastikan variabel $jumlahHariIni dikirim ke view
        return view('dashboard', ['jumlahHariIni' => $jumlahHariIni]);
    }
}
