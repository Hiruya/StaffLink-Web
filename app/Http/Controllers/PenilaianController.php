<?php

namespace App\Http\Controllers;

use App\Models\Penilaian;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    // Array kompetensi yang sama dengan di blade, simpan di properti
    protected $kompetensi = [
        ['Kategori' => 'Skill 35%', 'Kompetensi' => 'Kepemimpinan / Leadership'],
        ['Kategori' => '', 'Kompetensi' => 'Penyusunan Rencana & Strategi / Management Planning'],
        ['Kategori' => '', 'Kompetensi' => 'Analisa dan Penyelesaian Masalah / Analytical Thinking & Problem Solving'],
        ['Kategori' => '', 'Kompetensi' => 'Pengambilan Keputusan / Decision Making'],
        ['Kategori' => '', 'Kompetensi' => 'Kemampuan Presentasi / Presentation Skill'],
        ['Kategori' => '', 'Kompetensi' => 'Kerja sama tim / Teamwork'],
        ['Kategori' => '', 'Kompetensi' => 'Kemampuan Negosiasi / Negotiation Skills'],
        ['Kategori' => '', 'Kompetensi' => 'Kemampuan Pengembangan & pembelajaran / Learning skills'],
        ['Kategori' => '', 'Kompetensi' => 'Fokus Pelanggan / Customer Focus'],
        ['Kategori' => '', 'Kompetensi' => 'Orientasi pada kualitas kerja / Quality Orientation'],
        ['Kategori' => 'Kinerja 35%', 'Kompetensi' => 'Pencapaian Target Revenue'],
        ['Kategori' => '', 'Kompetensi' => 'Pertumbuhan pendapatan dan profitabilitas'],
        ['Kategori' => '', 'Kompetensi' => 'Inovasi kepemimpinan'],
        ['Kategori' => '', 'Kompetensi' => 'Pemeliharaan dan keamanan properti'],
        ['Kategori' => '', 'Kompetensi' => 'Kepuasan karyawan dan tamu'],
        ['Kategori' => 'Attitude 30%', 'Kompetensi' => 'Empati / Empathy'],
        ['Kategori' => '', 'Kompetensi' => 'Inisiatif'],
        ['Kategori' => '', 'Kompetensi' => 'Pelaksanaan 6K'],
        ['Kategori' => '', 'Kompetensi' => 'Kehadiran / Attendance'],
        ['Kategori' => '', 'Kompetensi' => 'Kedisiplinan / Discipline'],
    ];

    protected $kategori_bobot = [
        'Skill 35%' => 4,
        'Kinerja 35%' => 4,
        'Attitude 30%' => 4,
    ];

    // Fungsi untuk mendapatkan kategori berdasarkan index
    private function getKategoriByIndex($index)
    {
        $kategori = '';
        for ($i = 0; $i <= $index; $i++) {
            if (!empty($this->kompetensi[$i]['Kategori'])) {
                $kategori = $this->kompetensi[$i]['Kategori'];
            }
        }
        return $kategori;
    }

    // Fungsi untuk mendapatkan kompetensi berdasarkan index
    private function getKompetensiByIndex($index)
    {
        return $this->kompetensi[$index]['Kompetensi'] ?? '';
    }

    // Fungsi untuk mendapatkan bobot berdasarkan kategori index
    private function getBobotByKategori($index)
    {
        $kategori = $this->getKategoriByIndex($index);
        return $this->kategori_bobot[$kategori] ?? 0;
    }

    // Method menampilkan form penilaian
    public function index()
    {
        return view('penilaian.index', [
            'kompetensi' => $this->kompetensi,
            'kategori_bobot' => $this->kategori_bobot,
        ]);
    }

    // Method simpan data penilaian
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'divisi' => 'required|string|max:255',
            'komentar.*' => 'nullable|string|max:1000',
            'metode.*' => 'nullable|string|max:255',
            'target.*' => 'nullable|numeric|min:0|max:4',
            'aktual.*' => 'nullable|numeric|min:0|max:4',
        ]);

        $nama = $request->input('nama');
        $departemen = $request->input('divisi');

        $komentar = $request->input('komentar', []);
        $metode = $request->input('metode', []);
        $target = $request->input('target', []);
        $aktual = $request->input('aktual', []);

        $data = [];

        foreach ($this->kompetensi as $index => $item) {
            $data[] = [
                'nama' => $nama,
                'departemen' => $departemen,
                'kategori' => $this->getKategoriByIndex($index),
                'kompetensi' => $this->getKompetensiByIndex($index),
                'metode' => $metode[$index] ?? null,
                'target' => $target[$index] ?? null,
                'aktual' => $aktual[$index] ?? null,
                'komentar' => $komentar[$index] ?? null,
                'hasil_bobot' => (($aktual[$index] ?? 0) * $this->getBobotByKategori($index)),
                'gap' => (4 - ($aktual[$index] ?? 0)),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Penilaian::insert($data);

        return redirect()->route('penilaian.index')->with('success', 'Data penilaian berhasil disimpan.');
    }
}
