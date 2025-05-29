<?php

namespace App\Http\Controllers\User;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // Jika user biasa, tampilkan data absensinya
        if (auth()->user()->role->name === 'user') {
            $absensi = Absensi::where('user_id', auth()->id())->get();
            return view('absensi.index', compact('absensi'));
        }

        // Jika admin atau lainnya, tampilkan data user
        $query = User::with('role');

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($role = $request->input('role')) {
            $query->where('role_id', $role);
        }

        if ($sort = $request->input('sort')) {
            $query->orderBy($sort);
        }

        $users = $query->paginate(10);
        $roles = Role::all();

        return view('users.index', compact('users', 'roles'));
    }

    public function show(User $user)
    {
        return view('users.show', [
            'user' => $user,
            'roles' => Role::all()
        ]);
    }

    public function edit($userId)
    {
        $user = User::findOrFail($userId);
        $roles = Role::where('name', '!=', 'admin')->get(); // Exclude admin
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $userId)
    {
        $user = User::findOrFail($userId);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'nullable|exists:roles,_id'
        ]);

        if ($request->has('role')) {
            $selectedRole = Role::find($request->role);
            if ($selectedRole && $selectedRole->name === 'admin') {
                return redirect()->back()->with('error', 'Cannot assign admin role');
            }

            $user->role()->associate($validated['role']);
        }

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email']
        ]);

        $user->save();

        return redirect()->route('users.show', $user->id)
            ->with('success', 'User updated successfully');
    }

    public function resetPassword(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $newPassword = 'password'; // Gunakan yang lebih aman di production

        $user->update([
            'password' => Hash::make($newPassword)
        ]);

        return redirect()->route('users.show', $user->id)
            ->with('success', 'Password reset successfully. New password is: ' . $newPassword);
    }

    public function destroy($userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();

        return redirect()->route('admin.assign-role.index')->with('success', 'User deleted successfully');
    }

    public function first()
    {
        $user = User::first();

        if ($user) {
            return response()->json([
                'id' => $user->id,
                'nama' => $user->name,
            ]);
        } else {
            return response()->json([
                'message' => 'User tidak ditemukan'
            ], 404);
        }
    }
    public function updateProfile(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id, // validasi email unik kecuali milik user ini
        'password' => 'nullable|string|min:6|confirmed', // password boleh kosong, tapi kalau diisi harus minimal 6 dan harus ada password_confirmation
    ]);

    $user->name = $request->input('name');
    $user->email = $request->input('email');

    if ($request->filled('password')) {
        $user->password = bcrypt($request->input('password')); // hash password baru
    }

    $user->save();

    return response()->json([
        'message' => 'Profile updated successfully',
        'user' => $user,
    ]);
}
public function deleteAccount(Request $request)
{
    $user = Auth::user();

    // Opsi: kamu bisa tambahkan validasi konfirmasi password sebelum hapus akun
    $request->validate([
        'password' => 'required|string',
    ]);

    // Cek password sesuai user saat ini
    if (!\Hash::check($request->password, $user->password)) {
        return response()->json([
            'message' => 'Password salah, akun tidak dapat dihapus',
        ], 403);
    }

    // Hapus akun user
    $user->delete();

    return response()->json([
        'message' => 'Akun berhasil dihapus',
    ]);
}

}