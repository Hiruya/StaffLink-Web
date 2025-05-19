<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use MongoDB\Client as MongoClient;
use Illuminate\Support\Facades\DB; 

class ReportController extends Controller
{
    protected $mongo;

    public function __construct()
    {
        // Sambungkan ke MongoDB
        $this->mongo = new MongoClient('mongodb://127.0.0.1:27017');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'tanggal' => 'required|date',
            'nama' => 'required|string',
            'departemen' => 'required|string',
            'shift' => 'required|string',
            'jam_kerja' => 'required|string',
        ]);

        $pelayanan = [];
        $dokumentasi = [];

        for ($i = 1; $i <= 10; $i++) {
            // Ambil input pelayanan_1 sampai pelayanan_10
            $pelayanan[] = $request->input("pelayanan_$i") ?? '';

            // Cek apakah ada file dokumen_i
            if ($request->hasFile("dokumen_$i")) {
                $file = $request->file("dokumen_$i");
                $filename = time() . "_$i." . $file->getClientOriginalExtension();
                $file->move(public_path('uploads'), $filename);
                $dokumentasi[] = $filename;
            } else {
                // Ambil nama dokumentasi jika file tidak diupload (web)
                $dokumentasi[] = $request->input("dokumentasi_$i") ?? '';
            }
        }

        $collection = $this->mongo->selectDatabase('stafflink')->selectCollection('laporan_harians');

        $insertResult = $collection->insertOne([
            'email' => $request->email,
            'tanggal' => $request->tanggal,
            'nama' => $request->nama,
            'departemen' => $request->departemen,
            'shift' => $request->shift,
            'jam_kerja' => $request->jam_kerja,
            'jam_keluar' => now()->format('H:i:s'),
            'pelayanan' => json_encode($pelayanan),
            'dokumentasi' => json_encode($dokumentasi),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if ($insertResult->getInsertedCount() > 0) {
            return response()->json(['message' => 'Report berhasil disimpan'], 201);
        }

        return response()->json(['error' => 'Gagal menyimpan report'], 500);
    }
public function getReportData()
    {
        // Contoh isi method
        $data = DB::table('laporan_harians')
            ->select('tanggal', 'nama', 'departemen')
            ->get();

        return response()->json($data);
    }
}
