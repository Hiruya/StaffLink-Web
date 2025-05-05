<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Livewire\Volt\Component;

class UserController extends Controller
{
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
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $userId)
    {
        $user = User::findOrFail($userId);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'role' => 'nullable|exists:roles,id'
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email']
        ]);

        // Update role if provided
        if ($request->has('role')) {
            $user->role()->associate($validated['role']);
            $user->save();
        }

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
        return redirect()->route('admin.assign-role')->with('success', 'User deleted successfully');
    }
}
