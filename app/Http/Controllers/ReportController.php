<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use MongoDB\Client as MongoClient;
use Illuminate\Support\Facades\DB; 

use App\Models\LaporanHarian;

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
        'pelayanan' => 'nullable|string',
        'dokumentasi.*' => 'file|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);

    $docs = [];
    if ($request->hasFile('dokumentasi')) {
        foreach ($request->file('dokumentasi') as $file) {
            $path = $file->store('dokumentasi', 'public');
            $docs[] = asset('storage/' . $path);
        }
    }
        $laporan = LaporanHarian::create([
        'email' => $request->email,
        'tanggal' => $request->tanggal,
        'nama' => $request->nama,
        'departemen' => $request->departemen,
        'shift' => $request->shift,
        'jam_kerja' => $request->jam_kerja,
        'pelayanan' => $request->pelayanan,
        'dokumentasi' => json_encode($docs), // ✅ menggunakan variabel yang benar
    ]);
   /*  // Ubah array dokumentasi menjadi string
    $dokumentasiString = implode(',', $docs);

    $collection = $this->mongo->selectDatabase('stafflink')->selectCollection('laporan_harians');

    $insertResult = $collection->insertOne([
        'email' => $request->email,
        'tanggal' => $request->tanggal,
        'nama' => $request->nama,
        'departemen' => $request->departemen,
        'shift' => $request->shift,
        'jam_kerja' => $request->jam_kerja,
        'pelayanan' => $request->pelayanan,
        'dokumentasi' => $dokumentasiString, // Simpan sebagai string

    ]);
 */
    return response()->json(['message' => 'Data berhasil disimpan'], 200);
}



public function getReportData()
    {
        // Contoh isi method
        $data = DB::table('laporan_harians')
            ->select('email', 'tanggal', 'nama', 'departemen', 'shift','jam_kerja', 'pelayanan', 'dokumentasi')
            ->get();

        return response()->json($data);
    }
public function edit(LaporanHarian $laporanharian)
    {
        return view('laporanharian.edit', compact('laporanharian'));
    }

}