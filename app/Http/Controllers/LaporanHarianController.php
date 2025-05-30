<?php

namespace App\Http\Controllers;

use App\Models\LaporanHarian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LaporanHarianController extends Controller
{
    public function index()
    {
        $laporans = LaporanHarian::all();
        return response()->json($laporans); // Mengembalikan response JSON untuk daftar laporan
    }

    public function create()
    {
        return view('laporanharian.create');
    }

    public function store(Request $request)
{
    // Validasi
    $request->validate([
        'email' => 'required|email',
        'tanggal' => 'required|date',
        'nama' => 'required|string',
        'departemen' => 'required|string',
        'shift' => 'required|string',
        'jam_masuk' => 'required|date_format:H:i',
        'jam_keluar' => 'required|date_format:H:i',
        'pelayanan' => 'nullable|string',
        'dokumentasi.*' => 'file|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);

    $jam_kerja = $request->jam_masuk . ' - ' . $request->jam_keluar;

    $dokumentasiPaths = [];

    // Simpan semua file dokumentasi (multiple files)
    if ($request->hasFile('dokumentasi')) {
        foreach ($request->file('dokumentasi') as $file) {
            $path = $file->store('dokumentasi', 'public');
            $dokumentasiPaths[] = $path;
        }
    }

    // Simpan ke database
    $laporan = LaporanHarian::create([
        'email' => $request->email,
        'tanggal' => $request->tanggal,
        'nama' => $request->nama,
        'departemen' => $request->departemen,
        'shift' => $request->shift,
        'jam_kerja' => $jam_kerja,
        'pelayanan' => $request->pelayanan,
        'dokumentasi' => json_encode($dokumentasiPaths), // simpan path file sebagai json string
    ]);

   return response()->json('Data Post Berhasil Ditambahkan!', $laporan);
}



    public function edit(LaporanHarian $laporanharian)
    {
        return view('laporanharian.edit', compact('laporanharian'));
    }

    public function update(Request $request, LaporanHarian $laporanharian)
    {
        $request->validate([
            'email' => 'required|email',
            'tanggal' => 'required|date',
            'nama' => 'required|string',
            'departemen' => 'required|string',
            'shift' => 'required|string',
            'jam_masuk' => 'required|date_format:H:i',
            'jam_keluar' => 'required|date_format:H:i',
            'pelayanan' => 'nullable|string',
            'dokumentasi.*' => 'file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $jam_kerja = $request->jam_masuk . ' - ' . $request->jam_keluar;
        $existingDocs = [];

        if ($laporanharian->dokumentasi) {
            $existingDocs = explode(',', $laporanharian->dokumentasi);
        }

        if ($request->hasFile('dokumentasi')) {
            foreach ($request->file('dokumentasi') as $file) {
                $path = $file->store('dokumentasi', 'public');
                if ($path) {
                    $existingDocs[] = $path;
                }
            }
        }

        $laporanharian->update([
            'email' => $request->email,
            'tanggal' => $request->tanggal,
            'nama' => $request->nama,
            'departemen' => $request->departemen,
            'shift' => $request->shift,
            'jam_kerja' => $jam_kerja,
            'pelayanan' => $request->pelayanan,
            'dokumentasi' => !empty($existingDocs) ? implode(',', $existingDocs) : null,
        ]);

        return response()->json($laporanharian, 200); // Mengembalikan response JSON dari laporan yang diperbarui dengan status 200 (OK)
    }

    public function destroy(LaporanHarian $laporanharian)
    {
        if ($laporanharian->dokumentasi) {
            $paths = explode(',', $laporanharian->dokumentasi);
            foreach ($paths as $path) {
                Storage::disk('public')->delete($path);
            }
        }
        $laporanharian->delete();
        return response()->json(['message' => 'Data dihapus.'], 200); // Mengembalikan response JSON dengan pesan sukses
    }
}