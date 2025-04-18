<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index()
    {
        return view('absensi'); // pastikan view absensi.blade.php ada
    }
}
