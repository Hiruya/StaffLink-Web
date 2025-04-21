<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Http\Request;
use PDF;

class AbsensiController extends Controller
{
    // Menampilkan semua data absensi
    public function index()
    {
        $absensi = Absensi::with('user')->get();
        return view('absensi', compact('absensi'));
    }

    // Mengunduh PDF absensi
    public function downloadPDF()
    {
        $absensi = Absensi::with('user')->get();
        $pdf = PDF::loadView('absensi-pdf', compact('absensi'));

        return $pdf->download('laporan-absensi.pdf');
    }

    // Menampilkan detail absensi (View)
    public function show($id)
    {
        $absensi = Absensi::with('user')->findOrFail($id);
        return view('showabsen', compact('absensi'));
    }

    // Menampilkan form edit absensi
    public function edit($id)
    {
        $absensi = Absensi::with('user')->findOrFail($id);
        return view('editabsen', compact('absensi'));
    }

    // Memperbarui data absensi
    public function update(Request $request, $id)
    {
        $request->validate([
            'waktu_masuk' => 'required|date',
            'waktu_keluar' => 'nullable|date',
            'lokasi_masuk' => 'required|string',
            'lokasi_keluar' => 'nullable|string',
        ]);

        $absensi = Absensi::findOrFail($id);
        $absensi->update($request->all());

        return redirect()->route('absensi.index')->with('success', 'Data absensi berhasil diperbarui.');
    }
}
