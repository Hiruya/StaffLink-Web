<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use App\Models\Role;

class AssignUserRole extends Component
{
    public $users;
    public $roles = [];
    public $selectedRoles = [];

    protected $rules = [
        'selectedRoles.*' => 'exists:roles,_id'
    ];

    public function mount()
    {
        // Ambil semua user dan role
        $this->users = User::with('role')->get();
        $this->roles = Role::all();

        // Setel selectedRoles berdasarkan role yang dimiliki user
        foreach ($this->users as $user) {
            $this->selectedRoles[$user->id] = $user->role_id;
        }
    }

    public function updatedSelectedRoles($roleId, $userId)
    {
        $user = User::find($userId);
        if (!$user) {
            session()->flash('error', 'User tidak ditemukan');
            return;
        }

        // Jika role_id null (menghapus role)
        if (empty($roleId)) {
            $user->role_id = null;
            $user->save();
            session()->flash('success', 'Role berhasil dihapus');
            return;
        }

        // Update role
        if ($user->updateRole($userId, $roleId)) {
            session()->flash('success', 'Role berhasil diperbarui');
        }
    }


    public function render()
    {
        return view('livewire.admin.assign-user-role');
    }
}
