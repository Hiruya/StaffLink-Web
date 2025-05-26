<x-layouts.app>
@props([
    'users',
    'roles',
    'search' => '',
    'roleFilter' => '',
    'sortField' => 'name',
    'sortDirection' => 'asc',
])

<div class="space-y-4">
    <!-- Notifikasi -->
    @if (session()->has('success'))
        <div class="px-4 py-2 bg-zinc-100 text-zinc-800 rounded dark:bg-zinc-700 dark:text-zinc-100">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="px-4 py-2 bg-zinc-200 text-zinc-900 rounded dark:bg-zinc-700 dark:text-zinc-100">
            {{ session('error') }}
        </div>
    @endif

    <!-- Search and Filter -->
    <form method="GET" class="flex flex-col md:flex-row gap-4 justify-between items-start md:items-center">
    <input type="hidden" name="sort" value="{{ $sortField }}">
    <input type="hidden" name="direction" value="{{ $sortDirection }}">

    <!-- Search Field -->
        <div class="w-full md:w-auto">
            <label for="search" class="sr-only">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-zinc-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <input
                    type="text"
                    id="search"
                    name="search"
                    value="{{ $search }}"
                    class="bg-zinc-50 border border-zinc-300 text-zinc-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white"
                    placeholder="Search users...">
            </div>
        </div>

        <!-- Role Filter -->
        <div class="w-full md:w-auto">
            <label for="role_filter" class="sr-only">Filter by role</label>
            <select
                id="role_filter"
                name="role_filter"
                onchange="this.form.submit()"
                class="bg-zinc-50 border border-zinc-300 text-zinc-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white">
                <option value="">All Roles</option>
                @foreach($roles as $role)
                    @if($role->name !== 'admin')
                        <option value="{{ $role->slug }}" {{ $roleFilter == $role->slug ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endif
                @endforeach
            </select>
        </div>
    </form>

    <!-- Table -->
    <div class="overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-zinc-500 dark:text-zinc-400">
            <thead class="text-xs text-zinc-600 uppercase bg-zinc-100 dark:bg-zinc-800 dark:text-zinc-300">
                <tr>
                    @foreach ([
                        'name' => 'Nama',
                        'email' => 'Email',
                        'role_id' => 'Role'
                    ] as $field => $label)
                    <th scope="col" class="px-6 py-3">
                        <a href="{{ request()->fullUrlWithQuery([
                            'sort' => $field,
                            'direction' => ($sortField === $field && $sortDirection === 'asc') ? 'desc' : 'asc',
                            'search' => $search ?? '',
                            'role_filter' => $roleFilter ?? '',
                        ]) }}" class="flex items-center">
                            {{ $label }}
                            @if ($sortField === $field)
                                <svg class="w-3 h-3 ml-1.5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="{{ $sortDirection === 'asc' ? 'M19 9l-7 7-7-7' : 'M19 15l-7-7-7 7' }}"/>
                                </svg>
                            @endif
                        </a>
                    </th>
                    @endforeach
                    <th scope="col" class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr class="bg-zinc-50 border-b dark:bg-zinc-900 dark:border-zinc-700 hover:bg-zinc-200 dark:hover:bg-zinc-700">
                        <td class="px-6 py-4 font-medium text-zinc-900 whitespace-nowrap dark:text-white">
                            {{ $user->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $user->email }}
                        </td>
                        <td class="px-6 py-4">
                            <form method="POST" action="{{ route('admin.assign-role.update', $user->_id) }}" class="inline">
                                @csrf
                                @method('PUT')
                                <select name="role_id"
                                        onchange="this.form.submit()"
                                        class="bg-zinc-50 border border-zinc-300 text-zinc-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white">
                                    <option value="">No Role</option>
                                    @foreach($roles as $role)
                                        @if($role->name !== 'admin')
                                            <option value="{{ $role->_id }}" {{ $user->role_id == $role->_id ? 'selected' : '' }}>
                                                {{ $role->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </form>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-4">
                                <!-- Edit Button -->
                                <a href="{{ route('users.edit', $user->_id) }}"
                                class="p-1 text-zinc-500 hover:text-blue-600 dark:hover:text-blue-400 rounded-full hover:bg-blue-50 dark:hover:bg-zinc-700"
                                title="Edit User">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </a>

                                <!-- Delete Button -->
                                <form method="POST" action="{{ route('users.destroy', $user->_id) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            onclick="return confirm('Are you sure you want to delete this user?')"
                                            class="p-1 text-zinc-500 hover:text-red-600 dark:hover:text-red-400 rounded-full hover:bg-red-50 dark:hover:bg-zinc-700"
                                            title="Delete User">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-zinc-500 dark:text-zinc-400">No users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($users instanceof \Illuminate\Pagination\LengthAwarePaginator && $users->hasPages())
        <div class="px-4 py-3 bg-zinc-50 dark:bg-zinc-800">
            {{ $users->withQueryString()->links() }}
        </div>
    @endif
</div>
</x-layouts.app>
