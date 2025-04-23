<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\User;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwals = Jadwal::with('user')->get();
        return view('jadwal.index', compact('jadwals'));
    }
    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');
    
        if (!is_array($ids) || count($ids) === 0) {
            return back()->with('error', 'Tidak ada data yang dipilih.');
        }
    
        Jadwal::whereIn('id', $ids)->delete();
    
        return back()->with('success', 'Data berhasil dihapus.');
    }    
}