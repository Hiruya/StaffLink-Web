<?php

namespace App\Http\Controllers;

use App\Models\Penilaian;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
     // Menampilkan daftar penilaian
     public function index()
     {
         $kompetensi = [
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
         
         $kategori_bobot = [
             'Skill 35%' => 4,
             'Kinerja 35%' => 4,
             'Attitude 30%' => 4,
         ];
         
         return view('penilaian.index', compact('kompetensi', 'kategori_bobot'));
     }
 
     // Menyimpan data penilaian
     public function store(Request $request)
     {
         $data = [];
 
         foreach ($request->input('komentar') as $index => $komentar) {
             $kategori_sekarang = $request->input('kategori')[$index] ?? '';
             $kompetensi = $request->input('kompetensi')[$index] ?? '';
             $metode = $request->input('metode')[$index] ?? '';
             $target = $request->input('target')[$index] ?? 0;
             $aktual = $request->input('aktual')[$index] ?? 0;
             $hasil_bobot = $aktual * ($request->input('bobot')[$index] ?? 0);
             $gap = 4 - $aktual;
 
             // Membuat array data untuk disimpan
             $data[] = [
                 'kategori' => $kategori_sekarang,
                 'kompetensi' => $kompetensi,
                 'metode' => $metode,
                 'target' => $target,
                 'aktual' => $aktual,
                 'hasil_bobot' => $hasil_bobot,
                 'gap' => $gap,
                 'komentar' => $komentar,
                 'created_at' => now(),
                 'updated_at' => now(),
             ];
         }
 
         // Menyimpan data penilaian ke database
         Penilaian::insert($data);
 
         return redirect()->route('penilaian.index')->with('success', 'Penilaian berhasil disimpan.');
     }
 }