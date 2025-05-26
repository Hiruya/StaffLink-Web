<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use MongoDB\BSON\ObjectId;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
        public function __construct()
    {
        $this->middleware(['auth', 'role:karyawan']);
    }

    // public function index()
    // {
    //     $userId = new ObjectId(auth()->id());
    //     $karyawan = Karyawan::with(['user.role'])->where('user_id', auth()->id())->first();
    //     return view('karyawan.index', compact('karyawan'));
    // }

    public function index()
{
    $userId = new ObjectId(auth()->id());
    $karyawan = Karyawan::with(['user.role'])
            ->where('user_id', new ObjectId(auth()->id()))
            ->first();

    if (!$karyawan) {
        return redirect()->route('karyawan.create')->with('error', 'Silakan lengkapi data karyawan Anda terlebih dahulu.');
    }

    return view('karyawan.index', compact('karyawan'));
}

    public function create()
    {
        return view('karyawan.create');
    }

    public function store(Request $request)
    {
        $userId = new ObjectId(auth()->id());

    if (Karyawan::where('user_id', auth()->id())->exists()) {
        return redirect()->route('karyawan.index')->with('error', 'Data karyawan sudah ada.');
    }

        $validated = $request->validate([
            'employee_id' => 'required|integer|unique:karyawans,employee_id',
            'name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'region' => 'required|string|max:255',
            'education' => 'required|string|max:255',
            'gender' => 'required|string|in:male,female',
            'recruitment_channel' => 'required|string|max:255',
            'no_of_trainings' => 'required|integer|min:0',
            'age' => 'required|integer|min:18|max:65',
        ]);

        $validated['user_id'] = $userId;
        Karyawan::create($validated);
        return redirect()->route('karyawan.index')->with('success', 'Data karyawan berhasil disimpan.');
    }

    public function edit(string $id)
    {
        $karyawan = Karyawan::where('_id', $id)
                    ->where('user_id', auth()->id())
                    ->firstOrFail();

        return view('karyawan.edit', compact('karyawan'));
    }

    public function update(Request $request, string $id)
    {
        $karyawan = Karyawan::where('_id', $id)
                    ->where('user_id', auth()->id())
                    ->firstOrFail();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'region' => 'required|string|max:255',
            'education' => 'required|string|max:255',
            'gender' => 'required|string|in:male,female',
            'recruitment_channel' => 'required|string|max:255',
            'no_of_trainings' => 'required|integer|min:0',
            'age' => 'required|integer|min:18|max:65',
        ]);

        $karyawan->update($validated);

        return redirect()->route('karyawan.index')
                        ->with('success', 'Data karyawan berhasil diperbarui.');
    }
}
