<?php

namespace App\Http\Controllers;

use App\Models\Penilaian;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    public function index()
    {
        $penilaians = Penilaian::all();  // Mengambil semua data penilaian
        return view('penilaian.index', compact('penilaians'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'kompetensi' => 'required|string',
            'metode' => 'required|string',
            'target' => 'required|integer',
            'aktual' => 'required|integer|min:1|max:4',
            'komentar' => 'nullable|string'
        ]);

        // Menghitung gap dan hasil bobot
        $gap = $validated['target'] - $validated['aktual'];
        $hasil_bobot = $validated['aktual'] * $this->getBobot($validated['kompetensi']); // Bobot berdasarkan kompetensi

        // Menyimpan data ke dalam database
        Penilaian::create(array_merge($validated, [
            'gap' => $gap,
            'hasil_bobot' => $hasil_bobot,
        ]));

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Data penilaian berhasil disimpan!');
    }

    private function getBobot($kompetensi)
    {
        // Penentuan bobot berdasarkan kompetensi
        if (in_array($kompetensi, ['Kepemimpinan', 'Presentasi', 'Negosiasi'])) {
            return 4; // Bobot untuk skill (35%)
        } elseif (in_array($kompetensi, ['Revenue', 'Keamanan'])) {
            return 3; // Bobot untuk kinerja (35%)
        } else {
            return 2; // Bobot untuk attitude (30%)
        }
    }
}
