<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Http\Request;
use PDF;

class AbsensiController extends Controller
{
    // Menampilkan semua data absensi (untuk halaman web)
  public function index()
{
    // Ambil semua data absensi dengan relasi user, urut berdasarkan tanggal
    $data = \App\Models\Absensi::with('user')
        ->orderBy('tanggal', 'asc')
        ->orderBy('user_id', 'asc')
        ->get();

    // Group berdasarkan user_id dan tanggal supaya gabung data per user per tanggal
    $absensi = $data->groupBy(function ($item) {
        return $item->user_id . '_' . $item->tanggal;
    })->map(function ($group) {
        $first = $group->first();
        $user = $first->user;

        // Ambil waktu masuk paling awal di grup
        $waktu_masuk = $group->whereNotNull('waktu_masuk')->min('waktu_masuk');

        // Ambil waktu keluar paling akhir di grup
        $waktu_keluar = $group->whereNotNull('waktu_keluar')->max('waktu_keluar');

        // Hitung durasi jika waktu masuk dan keluar ada
        $durasi = ($waktu_masuk && $waktu_keluar)
            ? \Carbon\Carbon::parse($waktu_masuk)->diff(\Carbon\Carbon::parse($waktu_keluar))->format('%H:%I:%S')
            : '-';

        // Ambil keterangan dari tipe izin atau sakit jika ada
        // Jika ada banyak keterangan, ambil yang pertama yang bukan "-"
        $keterangan = $group->pluck('keterangan')->filter(function ($val) {
            return $val && $val !== '-';
        })->first() ?? '-';

        return (object)[
            'user' => $user,
            'tanggal' => $first->tanggal,
            'waktu_masuk' => $waktu_masuk,
            'waktu_keluar' => $waktu_keluar,
            'durasi' => $durasi,
            'keterangan' => $keterangan,
        ];
    })->values(); // reset index

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
            'waktu_pulang' => 'nullable|date',
            'keterangan' => 'nullable|string',
        ]);

        $absensi = Absensi::findOrFail($id);
        $absensi->update($request->only(['waktu_masuk', 'waktu_pulang', 'keterangan']));

        return redirect()->route('absensi.index')->with('success', 'Data absensi berhasil diperbarui.');
    }

    // Menyimpan data absensi dari API (Flutter)
   public function store(Request $request)
{
    try {
        // Validasi input
        $validated = $request->validate([
            'user_id' => 'required|string',
            'nama' => 'required|string',
            'tanggal' => 'required|date',
            'tipe' => 'required|in:masuk,pulang,sakit,izin',
            'keterangan' => 'nullable|string',
            'waktu_masuk' => 'nullable|date_format:H:i:s',
            'waktu_keluar' => 'nullable|date_format:H:i:s',
        ]);

        $userId = $request->user_id;
        $tanggal = $request->tanggal;
        $tipe = $request->tipe;

        // Cek absensi tipe sama hari ini (langsung blok jika sudah absen tipe sama)
        $sudahAbsenTipeIni = Absensi::where('user_id', $userId)
            ->where('tanggal', $tanggal)
            ->where('tipe', $tipe)
            ->exists();

        if ($sudahAbsenTipeIni) {
            return response()->json([
                'message' => "Anda sudah absen $tipe hari ini."
            ], 400);
        }

        // Cek apakah sudah absen masuk dan pulang hari ini (untuk batasi izin/sakit)
        if (in_array($tipe, ['izin', 'sakit'])) {
            $sudahAbsenMasuk = Absensi::where('user_id', $userId)
                ->where('tanggal', $tanggal)
                ->where('tipe', 'masuk')
                ->exists();

            $sudahAbsenPulang = Absensi::where('user_id', $userId)
                ->where('tanggal', $tanggal)
                ->where('tipe', 'pulang')
                ->exists();

            // Jika sudah absen masuk dan pulang, izin/sakit tidak boleh
            if ($sudahAbsenMasuk && $sudahAbsenPulang) {
                return response()->json([
                    'message' => 'Tidak bisa absen izin atau sakit setelah melakukan absen masuk dan pulang hari ini.'
                ], 400);
            }
        }

        // Ambil waktu sekarang
        $jamSekarang = now()->format('H:i:s');

        // Siapkan data untuk disimpan
        $data = [
            'user_id' => $userId,
            'nama' => $request->nama,
            'tanggal' => $tanggal,
            'tipe' => $tipe,
            'keterangan' => in_array($tipe, ['sakit', 'izin'])
                ? ($request->keterangan ?? '-')
                : '-',
        ];

        if ($tipe === 'masuk') {
            $data['waktu_masuk'] = $jamSekarang;
        } elseif ($tipe === 'pulang') {
            $data['waktu_keluar'] = $jamSekarang;
        }

        Absensi::create($data);

        return response()->json([
            'message' => 'Absen berhasil',
            'data' => $data,
        ], 201);

    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json(['errors' => $e->errors()], 422);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}


public function checkAbsen(Request $request)
{
    $validator = Validator::make($request->all(), [
        'user_id' => 'required|string',
        'tanggal' => 'required|date_format:Y-m-d',
        'tipe' => 'required|string|in:masuk,pulang,izin,sakit',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'Validasi gagal',
            'errors' => $validator->errors(),
        ], 422);
    }

    $userId = $request->input('user_id');
    $tanggal = $request->input('tanggal');
    $tipe = $request->input('tipe');

    // Untuk tipe izin/sakit, cek juga jika sudah absen masuk dan pulang
    if (in_array($tipe, ['izin', 'sakit'])) {
        $sudahAbsenMasuk = Absensi::where('user_id', $userId)
            ->where('tanggal', $tanggal)
            ->where('tipe', 'masuk')
            ->exists();

        $sudahAbsenPulang = Absensi::where('user_id', $userId)
            ->where('tanggal', $tanggal)
            ->where('tipe', 'pulang')
            ->exists();

        if ($sudahAbsenMasuk && $sudahAbsenPulang) {
            // Jika sudah absen masuk & pulang, tidak bisa izin/sakit
            return response()->json([
                'success' => true,
                'exists' => true,  // kita tandai sudah "ada", supaya Flutter menolak izin/sakit
            ]);
        }
    }

    $exists = Absensi::where('user_id', $userId)
        ->where('tanggal', $tanggal)
        ->where('tipe', $tipe)
        ->exists();

    return response()->json([
        'success' => true,
        'exists' => $exists,
    ]);
}
}