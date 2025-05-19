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

    // Menampilkan detail absensi
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
            'waktu_kerja' => 'nullable|date',
            'keterangan' => 'nullable|string',
        ]);

        $absensi = Absensi::findOrFail($id);
        $absensi->update($request->all());

        return redirect()->route('absensi.index')->with('success', 'Data absensi berhasil diperbarui.');
    }

    // Absen masuk (API)
    public function masuk(Request $request)
    {
        $userId = $request->user_id;

        $absen = Absensi::create([
            'user_id' => $userId,
            'waktu_masuk' => now(),
        ]);

        return response()->json(['message' => 'Absen masuk berhasil', 'data' => $absen]);
    }

    // Absen pulang (API)
    public function pulang(Request $request)
    {
        $userId = $request->user_id;

        $absen = Absensi::where('user_id', $userId)
            ->whereDate('waktu_masuk', today())
            ->latest()
            ->first();

        if ($absen) {
            $absen->update(['waktu_keluar' => now()]);
            return response()->json(['message' => 'Absen pulang berhasil', 'data' => $absen]);
        }

        return response()->json(['message' => 'Absen masuk belum ditemukan'], 404);
    }

    // Keterangan (izin/sakit)
    public function keterangan(Request $request)
    {
        $userId = $request->user_id;
        $keterangan = $request->keterangan; // Contoh: 'izin' atau 'sakit'

        $absen = Absensi::create([
            'user_id' => $userId,
            'keterangan' => $keterangan,
        ]);

        return response()->json(['message' => 'Keterangan berhasil ditambahkan', 'data' => $absen]);
    }
}
