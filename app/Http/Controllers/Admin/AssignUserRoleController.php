<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use MongoDB\BSON\ObjectId;
use App\Models\User;
use App\Models\Role;

class AssignUserRoleController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->input('search');
        $roleFilter = $request->input('role_filter');
        $sortField = $request->input('sort', 'name');
        $sortDirection = $request->input('direction', 'asc');

        $query = User::query();

        // Filter berdasarkan search
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%");
            });
        }

        // Ambil semua role selain admin
        $roles = Role::where('name', '!=', 'admin')->get();

        // Ambil daftar role_id selain admin
        $nonAdminRoleIds = $roles->pluck('_id')->map(function ($id) {
        return new ObjectId((string) $id);
        })->toArray();

        // Filter berdasarkan role jika ada
        if ($roleFilter) {
            $filteredRole = Role::where('slug', $roleFilter)->first();
            if ($filteredRole) {
                $query->where('role_id', $filteredRole->_id);
            } else {
                // Jika slug tidak cocok, tampilkan kosong
                $query->whereNull('role_id');
            }
        } else {
            // Default tampilkan semua user dengan role_id bukan admin dan juga user tanpa role
            $query->where(function ($q) use ($nonAdminRoleIds) {
                $q->whereIn('role_id', $nonAdminRoleIds)
                ->orWhereNull('role_id');
            });
        }

        // Sorting
        $query->orderBy($sortField, $sortDirection);

        $users = $query->paginate(10);

        return view('admin.assign-user-role', [
            'users' => $users,
            'roles' => Role::all(),
            'search' => $search,
            'roleFilter' => $roleFilter,
            'sortField' => $sortField,
            'sortDirection' => $sortDirection,
        ]);
    }


        // public function update(Request $request, $userId)
        // {
        //     $request->validate([
        //         'role_id' => 'nullable|exists:roles,_id',
        //     ]);

        //     $user = User::findOrFail($userId);

        //     // Tidak bisa modifikasi user admin
        //     if (optional($user->role)->name === 'admin') {
        //         return redirect()->back()->with('error', 'Cannot modify admin user');
        //     }

        //     // Tidak bisa assign role admin
        //     if ($request->filled('role_id')) {
        //         $selectedRole = Role::find($request->role_id);
        //         if ($selectedRole && $selectedRole->name === 'admin') {
        //             return redirect()->back()->with('error', 'Cannot assign admin role');
        //         }
        //     }

        //     $user->role_id = new ObjectId($request->role_id);
        //     $user->save();

        //     return redirect()->back()->with('success', 'Role updated successfully');
        // }

        public function update(Request $request, $userId)
    {
        $request->validate([
            'role_id' => 'nullable|string',
        ]);

        $user = User::findOrFail($userId);

        // Cegah modifikasi user admin
        if (optional($user->role)->name === 'admin') {
            return redirect()->back()->with('error', 'Cannot modify admin user');
        }

        // Jika role_id tidak diisi (No Role), set ke null
        if (!$request->filled('role_id')) {
            $user->role_id = null;
        } else {
            // Cegah assign role admin
            $selectedRole = Role::find($request->role_id);
            if ($selectedRole && $selectedRole->name === 'admin') {
                return redirect()->back()->with('error', 'Cannot assign admin role');
            }
            $user->role_id = new ObjectId($request->role_id);
        }

        $user->save();

        return redirect()->back()->with('success', 'Role updated successfully');
    }
}
