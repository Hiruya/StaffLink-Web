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
        $data = $request->validate([
            'email' => 'required|email',
            'tanggal' => 'required|date',
            'nama' => 'required|string',
            'departemen' => 'required|string',
            'shift' => 'required|string',
            'jam_masuk' => 'required',
            'jam_keluar' => 'required',
            'pelayanan' => 'nullable|string',
            'dokumentasi.*' => 'file|mimes:jpg,jpeg,png,pdf|max:2048'
        ]);

        $docs = [];
        if ($request->hasFile('dokumentasi')) {
            foreach ($request->file('dokumentasi') as $file) {
                $docs[] = $file->store('dokumentasi', 'public');
            }
            $data['dokumentasi'] = implode(',', $docs);
        } else {
            $data['dokumentasi'] = null;
        }

        LaporanHarian::create($data);

        return redirect()->route('laporanharian.index')->with('success', 'Data disimpan.');
    }

    public function edit(LaporanHarian $laporanharian)
    {
        return view('laporanharian.edit', compact('laporanharian'));
    }

    public function update(Request $request, LaporanHarian $laporanharian)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'tanggal' => 'required|date',
            'nama' => 'required|string',
            'departemen' => 'required|string',
            'shift' => 'required|string',
            'jam_masuk' => 'required',
            'jam_keluar' => 'required',
            'pelayanan' => 'nullable|string',
            'dokumentasi.*' => 'file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $existingDocs = [];
        if ($laporanharian->dokumentasi) {
            $existingDocs = explode(',', $laporanharian->dokumentasi);
        }

        if ($request->hasFile('dokumentasi')) {
            foreach ($request->file('dokumentasi') as $file) {
                $existingDocs[] = $file->store('dokumentasi', 'public');
            }
        }

        $data['dokumentasi'] = !empty($existingDocs) ? implode(',', $existingDocs) : null;

        $laporanharian->update($data);

        return redirect()->route('laporanharian.index')->with('success', 'Data diperbarui.');
    }

    public function destroy(LaporanHarian $laporanharian)
    {
        $laporanharian->delete();
        return redirect()->route('laporanharian.index')->with('success', 'Data dihapus.');
    }
}
