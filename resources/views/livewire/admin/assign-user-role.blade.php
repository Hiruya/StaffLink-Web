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
    <div class="flex flex-col md:flex-row gap-4 justify-between items-start md:items-center">
        <!-- Search -->
        <div class="w-full md:w-auto">
            <label for="search" class="sr-only">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-zinc-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <input
                    wire:model.live.debounce.300ms="search"
                    type="text"
                    id="search"
                    class="bg-zinc-50 border border-zinc-300 text-zinc-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white"
                    placeholder="Search users...">
            </div>
        </div>

        <!-- Role Filter -->
        <div class="w-full md:w-auto">
            <label for="role_filter" class="sr-only">Filter by role</label>
            <select
                wire:model.live="roleFilter"
                id="role_filter"
                class="bg-zinc-50 border border-zinc-300 text-zinc-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white">
                <option value="">All Roles</option>
                @foreach($roles as $role)
                    <option value="{{ $role->_id }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-zinc-500 dark:text-zinc-400">
            <thead class="text-xs text-zinc-600 uppercase bg-zinc-100 dark:bg-zinc-800 dark:text-zinc-300">
                <tr>
                    <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="sortBy('name')">
                        <div class="flex items-center">
                            Nama
                            @if($sortField === 'name')
                                <svg class="w-3 h-3 ml-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                                </svg>
                            @endif
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="sortBy('email')">
                        <div class="flex items-center">
                            Email
                            @if($sortField === 'email')
                                <svg class="w-3 h-3 ml-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                                </svg>
                            @endif
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="sortBy('role_id')">
                        <div class="flex items-center">
                            Role
                            @if($sortField === 'role_id')
                                <svg class="w-3 h-3 ml-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                                </svg>
                            @endif
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="bg-zinc-50 border-b dark:bg-zinc-900 dark:border-zinc-700 hover:bg-zinc-200 dark:hover:bg-zinc-700">
                        <td class="px-6 py-4 font-medium text-zinc-900 whitespace-nowrap dark:text-white">
                            {{ $user->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $user->email }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $user->role->name ?? 'No Role' }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-3">
                                <a href="{{ route('users.show', $user->_id) }}"
                                   class="font-medium text-zinc-700 dark:text-zinc-300 hover:underline"
                                   wire:navigate>
                                    View
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($users->hasPages())
        <div class="px-4 py-3 bg-zinc-50 dark:bg-zinc-800">
            {{ $users->links() }}
        </div>
    @endif
</div>
