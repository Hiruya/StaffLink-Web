<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use Carbon\Carbon;
use MongoDB\Client as MongoClient;

class DashboardController extends Controller
{
    // Tampilkan halaman dashboard
    public function index()
    {
    $today = date('Y-m-d');  // string tanggal hari ini
    $jumlahHariIni = Absensi::where('tanggal', $today)->count();

    return view('dashboard', ['jumlahHariIni' => $jumlahHariIni]);
}

    // API untuk ambil data promosi dari MongoDB
   public function getGrafikPromosi()
{
    $mongo = new MongoClient(config('database.mongodb.dsn'));
    $collection = $mongo->staff_db->predictions;

    $promosi = $collection->countDocuments(['prediction' => 'promoted']);
    $tidakPromosi = $collection->countDocuments(['prediction' => 'not_promoted']);

    return response()->json([
        'promosi' => $promosi,
        'tidak_promosi' => $tidakPromosi,
    ]);
}
}
