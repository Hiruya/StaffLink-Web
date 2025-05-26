<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Livewire\Volt\Component;
use App\Http\Controllers\Controller;


class UserController extends Controller
{
<<<<<<< HEAD:app/Http/Controllers/UserController.php
    public function index()
{
    $absensi = Absensi::where('user_id', auth()->id())->get();

    return view('absensi.index', compact('absensi'));
}

=======
    public function index(Request $request)
{
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
>>>>>>> 1ddeb12b5d79f5be383beb15b2ae9253a85e505e:app/Http/Controllers/User/UserController.php

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
            'email' => 'required|email|unique:users,email,'.$user->id,
            'role' => 'nullable|exists:roles,_id'
        ]);

        // Cek jika mencoba assign role admin
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

        // Generate a random password or use a default one
        $newPassword = 'password'; // In production, use something more secure

        $user->update([
            'password' => Hash::make($newPassword)
        ]);

        return redirect()->route('users.show', $user->id)
            ->with('success', 'Password reset successfully. New password is: '.$newPassword);
    }

    public function destroy($userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();

        // Correct the route name to match your route definition
        return redirect()->route('admin.assign-role.index')->with('success', 'User deleted successfully');
    }

public function first()
{
    $user = User::first(); // Mengambil data user pertama dari tabel users

    if ($user) {
        return response()->json([
            'id' => $user->id,
            'nama' => $user->name, // atau 'nama' kalau kolom di database kamu pakai nama itu
        ]);
    } else {
        return response()->json([
            'message' => 'User tidak ditemukan'
        ], 404);
    }
}

}
