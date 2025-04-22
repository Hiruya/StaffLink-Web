<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        return view('jadwal'); // pastikan view ini ada di resources/views/jadwal.blade.php
    }
}
