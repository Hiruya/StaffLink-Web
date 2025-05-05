<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use App\Models\Role;
use Livewire\WithPagination;

class AssignUserRole extends Component
{
    use WithPagination;

    public $roles = [];
    public $selectedRoles = [];
    public $search = '';
    public $roleFilter = '';
    public $sortField = 'name';
    public $sortDirection = 'asc';

    protected $rules = [
        'selectedRoles.*' => 'exists:roles,_id'
    ];

    public function mount()
    {
        // Get all roles
        $this->roles = Role::all();

        // Initialize selectedRoles for existing users
        $users = User::all();
        foreach ($users as $user) {
            $this->selectedRoles[$user->id] = $user->role_id;
        }
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function getUsersProperty()
    {
        $query = User::with('role');

        // Search
        if ($this->search) {
            $query->where(function($q) {
                $q->where('name', 'like', '%'.$this->search.'%')
                  ->orWhere('email', 'like', '%'.$this->search.'%');
            });
        }

        // Role Filter
        if ($this->roleFilter) {
            $query->where('role_id', $this->roleFilter);
        }

        // Sorting
        $query->orderBy($this->sortField, $this->sortDirection);

        return $query->paginate(10);
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
        return view('livewire.admin.assign-user-role', [
            'users' => $this->users
        ]);
    }
}
