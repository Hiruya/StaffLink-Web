<?php

namespace App\Http\Controllers;

use App\Models\LaporanHarian;
use Illuminate\Http\Request;

class LaporanHarianController extends Controller
{
    public function index()
    {
        $laporans = LaporanHarian::all();
        return view('laporanharian.index', compact('laporans'));
    }

    public function create()
    {
        return view('laporanharian.create');
    }

    public function store(Request $request)
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
            'dokumentasi.*' => 'file|mimes:jpg,jpeg,png,pdf|max:2048'
        ]);

        $jam_kerja = $request->jam_masuk . ' - ' . $request->jam_keluar;

        // Proses dokumentasi
        $dokumentasiPaths = [];
        if ($request->hasFile('dokumentasi')) {
            foreach ($request->file('dokumentasi') as $file) {
                $path = $file->store('dokumentasi', 'public');
                if ($path) {
                    $dokumentasiPaths[] = $path;
                }
            }
        }

        LaporanHarian::create([
            'email' => $request->email,
            'tanggal' => $request->tanggal,
            'nama' => $request->nama,
            'departemen' => $request->departemen,
            'shift' => $request->shift,
            'jam_kerja' => $jam_kerja,
            'pelayanan' => $request->pelayanan,
            'dokumentasi' => !empty($dokumentasiPaths) ? implode(',', $dokumentasiPaths) : null,
        ]);

        return redirect()->route('laporanharian.index')->with('success', 'Data disimpan.');
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

        return redirect()->route('laporanharian.index')->with('success', 'Data diperbarui.');
    }

    public function destroy(LaporanHarian $laporanharian)
    {
        $laporanharian->delete();
        return redirect()->route('laporanharian.index')->with('success', 'Data dihapus.');
    }
}
