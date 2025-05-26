<x-layouts.app title="Edit {{ $user->name }} - Profil User">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
            <div>
                <div class="flex items-center gap-3">
                    <h1 class="text-3xl font-bold text-zinc-900 dark:text-white">Edit Profil User</h1>
                    <span class="inline-flex px-3 py-1 rounded-full text-xs font-medium
                        {{ $user->role ? 'bg-zinc-700 text-zinc-100 dark:bg-zinc-600 dark:text-zinc-200' : 'bg-zinc-200 text-zinc-800 dark:bg-zinc-700 dark:text-zinc-300' }}">
                        {{ $user->role->name ?? 'No Role' }}
                    </span>
                </div>
                <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Perbarui detail dan izin pengguna</p>
            </div>
            <a href="{{ route('admin.assign-role.index', $user->_id) }}"
               class="inline-flex items-center px-4 py-2 border border-zinc-300 text-sm font-medium rounded-lg text-zinc-700 bg-white hover:bg-zinc-100 dark:bg-zinc-800 dark:text-zinc-300 dark:border-zinc-600 dark:hover:bg-zinc-700 transition-colors duration-200"
               wire:navigate>
                <x-heroicon-o-arrow-left class="h-5 w-5 mr-2" />
                Kembali
            </a>
        </div>

        <!-- Form Card -->
        <div class="bg-white shadow-xl rounded-xl overflow-hidden dark:bg-zinc-800 transition-all duration-300">
            <form method="POST" action="{{ route('users.update', $user->_id) }}">
                @csrf
                @method('PUT')

                <!-- Card Header -->
                <div class="bg-gradient-to-r from-zinc-700 to-zinc-900 dark:from-zinc-700 dark:to-zinc-800 px-6 py-8 flex flex-col sm:flex-row items-start sm:items-center gap-6">
                    <div class="relative">
                        <div class="h-20 w-20 rounded-full bg-white dark:bg-zinc-200 flex items-center justify-center text-zinc-800 dark:text-zinc-700 text-2xl font-bold border-4 border-white dark:border-zinc-300 shadow-md">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <span class="absolute bottom-0 right-0 bg-green-500 rounded-full h-5 w-5 border-2 border-white dark:border-zinc-300"></span>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-white">{{ $user->name }}</h2>
                        <p class="text-zinc-200">{{ $user->email }}</p>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="px-6 py-6 space-y-8">
                    <!-- Informasi Dasar -->
                    <div>
                        <h3 class="text-lg font-semibold text-zinc-900 dark:text-white mb-4 pb-2 border-b border-zinc-200 dark:border-zinc-700">Informasi Dasar</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-zinc-500 dark:text-zinc-400 mb-1">Nama Lengkap</label>
                                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                                    class="mt-1 p-3 block w-full rounded-lg border-zinc-300 shadow-sm focus:border-zinc-700 focus:ring-zinc-700 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white dark:placeholder-zinc-400">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-zinc-500 dark:text-zinc-400 mb-1">Alamat Email</label>
                                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                                    class="mt-1 p-3 block w-full rounded-lg border-zinc-300 shadow-sm focus:border-zinc-700 focus:ring-zinc-700 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white dark:placeholder-zinc-400">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Role -->
                    <div>
                        <h3 class="text-lg font-semibold text-zinc-900 dark:text-white mb-4 pb-2 border-b border-zinc-200 dark:border-zinc-700">Role</h3>
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            @foreach($roles as $role)
                                <label class="flex items-center text-sm text-zinc-700 dark:text-zinc-300">
                                    <input type="radio" name="role" value="{{ $role->id }}"
                                           class="mr-2 h-4 w-4 text-zinc-700 focus:ring-zinc-700 border-zinc-300 dark:bg-zinc-700 dark:border-zinc-600"
                                           {{ $user->role && $user->role->id === $role->id ? 'checked' : '' }}>
                                    {{ $role->name }}
                                </label>
                            @endforeach
                        </div>
                        @error('role')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Footer -->
                <div class="px-6 py-4 bg-zinc-50 dark:bg-zinc-700 border-t border-zinc-200 dark:border-zinc-700 flex flex-col sm:flex-row justify-between gap-4">
                    <div class="flex gap-3">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-zinc-800 text-white rounded-lg font-semibold text-xs uppercase tracking-widest hover:bg-zinc-700 focus:outline-none focus:ring-2 focus:ring-zinc-600 transition">
                            <x-heroicon-s-check class="-ml-1 mr-2 h-5 w-5" />
                            Simpan
                        </button>
                        <a href="{{ route('users.show', $user->_id) }}"
                           class="inline-flex items-center px-4 py-2 bg-zinc-200 text-zinc-800 rounded-lg font-semibold text-xs uppercase hover:bg-zinc-300 dark:bg-zinc-600 dark:text-zinc-200 dark:hover:bg-zinc-500 focus:outline-none focus:ring-2 focus:ring-zinc-500 transition">
                            Batalkan
                        </a>
                    </div>
                    <button type="button"
                        onclick="confirm('Reset password user ini?') && document.getElementById('reset-password-form').submit();"
                        class="inline-flex items-center px-4 py-2 bg-yellow-500 text-white rounded-lg font-semibold text-xs uppercase hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 transition">
                        <x-heroicon-s-lock-closed class="-ml-1 mr-2 h-5 w-5" />
                        Reset Password
                    </button>
                </div>
            </form>

            <!-- Reset Form -->
            <form id="reset-password-form" method="POST" action="{{ route('users.reset-password', $user->_id) }}" class="hidden">
                @csrf
                @method('PUT')
            </form>
        </div>
    </div>
</x-layouts.app>
