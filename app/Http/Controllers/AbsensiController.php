<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use PDF; // Ini harus diletakkan di atas, bersama use lainnya

class AbsensiController extends Controller
{
    public function index()
    {
        $absensi = Absensi::with('user')->get();
        return view('absensi', compact('absensi'));
    }

    public function downloadPDF()
    {
        $absensi = Absensi::with('user')->get();
        $pdf = PDF::loadView('absensi-pdf', compact('absensi'));

        return $pdf->download('laporan-absensi.pdf');
    }
}
