<?php

namespace App\Http\Controllers\Hrd;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class HrdController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:hrd']);
    }

    public function index()
    {
        $karyawans = Karyawan::with('user')
                    ->orderBy('name')
                    ->paginate(10);

        return view('hrd.index', compact('karyawans'));
    }

    public function show(string $id)
    {
        $karyawan = Karyawan::with('user')->findOrFail($id);
        return view('hrd.show', compact('karyawan'));
    }
}
