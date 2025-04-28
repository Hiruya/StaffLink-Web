{{-- <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
            <div>
                <div class="flex items-center gap-3">
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">User Profile</h1>
                    <span class="inline-flex px-3 py-1 rounded-full text-xs font-medium {{ $user->role ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' }}">
                        {{ $user->role->name ?? 'No Role' }}
                    </span>
                </div>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Manage user details and permissions</p>
            </div>
            <div class="flex gap-2 w-full sm:w-auto">
                <a href="{{ route('admin.assign-role') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-700 transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Users
                </a>
            </div>
        </div>

        <!-- User Details Card -->
        <div class="bg-white shadow-xl rounded-xl overflow-hidden dark:bg-gray-800 transition-all duration-300 hover:shadow-2xl">
            <!-- Profile Header with Avatar -->
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 dark:from-blue-600 dark:to-blue-700 px-6 py-8 flex flex-col sm:flex-row items-start sm:items-center gap-6">
                <div class="relative">
                    <div class="h-20 w-20 rounded-full bg-white dark:bg-gray-200 flex items-center justify-center text-blue-600 dark:text-blue-800 text-2xl font-bold border-4 border-white dark:border-gray-300 shadow-md">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <span class="absolute bottom-0 right-0 bg-green-500 rounded-full h-5 w-5 border-2 border-white dark:border-gray-300"></span>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-white">{{ $user->name }}</h2>
                    <p class="text-blue-100 dark:text-blue-200">{{ $user->email }}</p>
                </div>
            </div>

            <!-- Card Body -->
            <div class="px-6 py-6 space-y-8">
                <!-- Basic Information Section -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">Basic Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Name Field -->
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Full Name</label>
                            <div class="mt-1 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg dark:text-gray-200 border border-gray-200 dark:border-gray-600">
                                {{ $user->name }}
                            </div>
                        </div>

                        <!-- Email Field -->
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Email Address</label>
                            <div class="mt-1 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg dark:text-gray-200 border border-gray-200 dark:border-gray-600">
                                {{ $user->email }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional Information Section (example) -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">Account Details</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Registration Date -->
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Member Since</label>
                            <div class="mt-1 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg dark:text-gray-200 border border-gray-200 dark:border-gray-600">
                                {{ $user->created_at->format('M d, Y') }}
                            </div>
                        </div>

                        <!-- Last Active -->
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Last Active</label>
                            <div class="mt-1 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg dark:text-gray-200 border border-gray-200 dark:border-gray-600">
                                {{ $user->updated_at->diffForHumans() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Footer -->
            <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700 border-t border-gray-200 dark:border-gray-700 flex flex-col sm:flex-row justify-between gap-4">
                <div class="flex gap-3">
                    <a href="{{ route('users.edit', $user->_id) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150 dark:bg-blue-500 dark:hover:bg-blue-600">
                        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                        Edit Profile
                    </a>

                    <button class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-lg font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150 dark:bg-gray-600 dark:text-gray-200 dark:hover:bg-gray-500">
                        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        Reset Password
                    </button>
                </div>

                <form method="POST" action="{{ route('users.destroy', $user->_id) }}" onsubmit="return confirm('Are you sure you want to delete this user? This action cannot be undone.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150 dark:bg-red-500 dark:hover:bg-red-600 w-full sm:w-auto justify-center">
                        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        Delete User
                    </button>
                </form>
            </div>
        </div>
    </div>
</div> --}}

{{-- <div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">User Details</h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Manage user information and roles</p>
            </div>
            <div>
                <a href="{{ route('users.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-700">
                    Back to Users
                </a>
            </div>
        </div>

        <!-- User Details Card -->
        <div class="bg-white shadow rounded-lg overflow-hidden dark:bg-gray-800">
            <!-- Card Header -->
            <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700">
                <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">User Information</h3>
            </div>

            <!-- Card Body -->
            <div class="px-6 py-6 space-y-6">
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <!-- Name Field -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Full Name</label>
                        <div class="mt-1 p-3 bg-gray-50 rounded-md dark:bg-gray-700 dark:text-gray-200">
                            {{ $user->name }}
                        </div>
                    </div>

                    <!-- Email Field -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email Address</label>
                        <div class="mt-1 p-3 bg-gray-50 rounded-md dark:bg-gray-700 dark:text-gray-200">
                            {{ $user->email }}
                        </div>
                    </div>
                </div>

                <!-- Role Assignment Section -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Role Assignment</label>
                    <div class="mt-2 flex items-center gap-4">
                        @if(isset($roles) && $roles->count())
                            <select wire:model="selectedRole" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="">-- Select Role --</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->_id }}" @selected($user->role_id == $role->_id)>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>

                            <button wire:click="updateRole" class="px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150 dark:bg-blue-500 dark:hover:bg-blue-600">
                                Update Role
                            </button>
                        @else
                            <div class="text-red-500 dark:text-red-400">No roles available</div>
                        @endif
                    </div>
                </div>

            <!-- Card Footer -->
            <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700 border-t border-gray-200 dark:border-gray-700 flex justify-between">
                <a href="{{ route('users.edit', $user->_id) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150 dark:bg-blue-500 dark:hover:bg-blue-600">
                    Edit Profile
                </a>

                <form method="POST" action="{{ route('users.destroy', $user->_id) }}" onsubmit="return confirm('Are you sure you want to delete this user?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-800 focus:outline-none focus:border-red-900 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150 dark:bg-red-500 dark:hover:bg-red-600">
                        Delete User
                    </button>
                </form>
            </div>
        </div>
    </div>
</div> --}}


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="User profile management page">
    <title>{{ $user->name }} - User Profile</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Tailwind CSS or other stylesheets -->
</head>
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
            <div>
                <div class="flex items-center gap-3">
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">User Profile</h1>
                    <span class="inline-flex px-3 py-1 rounded-full text-xs font-medium {{ $user->role ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' }}">
                        {{ $user->role->name ?? 'No Role' }}
                    </span>
                </div>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Kelola detail dan izin pengguna</p>
            </div>
            <div class="flex gap-2 w-full sm:w-auto">
                <a href="{{ route('admin.assign-role') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-700 transition-colors duration-200" aria-label="Back to users list" wire:navigate>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </a>
            </div>
        </div>

        <!-- User Details Card -->
        <div class="bg-white shadow-xl rounded-xl overflow-hidden dark:bg-gray-800 transition-all duration-300 hover:shadow-2xl">
            <!-- Profile Header with Avatar -->
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 dark:from-blue-600 dark:to-blue-700 px-6 py-8 flex flex-col sm:flex-row items-start sm:items-center gap-6">
                <div class="relative">
                    <div class="h-20 w-20 rounded-full bg-white dark:bg-gray-200 flex items-center justify-center text-blue-600 dark:text-blue-800 text-2xl font-bold border-4 border-white dark:border-gray-300 shadow-md" aria-hidden="true">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <span class="absolute bottom-0 right-0 bg-green-500 rounded-full h-5 w-5 border-2 border-white dark:border-gray-300" aria-label="Online status"></span>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-white">{{ $user->name }}</h2>
                    <p class="text-blue-100 dark:text-blue-200">{{ $user->email }}</p>
                </div>
            </div>

            <!-- Card Body -->
            <div class="px-6 py-6 space-y-8">
                <!-- Basic Information Section -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">Informasi Dasar</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Name Field -->
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Nama Lengkap</label>
                            <div class="mt-1 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg dark:text-gray-200 border border-gray-200 dark:border-gray-600">
                                {{ $user->name }}
                            </div>
                        </div>

                        <!-- Email Field -->
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Alamat Email</label>
                            <div class="mt-1 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg dark:text-gray-200 border border-gray-200 dark:border-gray-600">
                                {{ $user->email }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional Information Section -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">Detail Akun</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Registration Date -->
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Anggota Sejak</label>
                            <div class="mt-1 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg dark:text-gray-200 border border-gray-200 dark:border-gray-600">
                                {{ $user->created_at->format('M d, Y') }}
                            </div>
                        </div>

                        {{-- <!-- Last Active -->
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Last Active</label>
                            <div class="mt-1 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg dark:text-gray-200 border border-gray-200 dark:border-gray-600">
                                {{ $user->updated_at->diffForHumans() }}
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>

            <!-- Card Footer -->
            <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700 border-t border-gray-200 dark:border-gray-700 flex flex-col sm:flex-row justify-between gap-4">
                <div class="flex gap-3">
                    <a href="{{ route('users.edit', $user->_id) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150 dark:bg-blue-500 dark:hover:bg-blue-600" aria-label="Edit user profile">
                        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                        Edit Profil
                    </a>

                    <button class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-lg font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150 dark:bg-gray-600 dark:text-gray-200 dark:hover:bg-gray-500" aria-label="Reset password">
                        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        Reset Password
                    </button>
                </div>

                <form method="POST" action="{{ route('users.destroy', $user->_id) }}" onsubmit="return confirm('Are you sure you want to delete this user? This action cannot be undone.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150 dark:bg-red-500 dark:hover:bg-red-600 w-full sm:w-auto justify-center" aria-label="Delete user">
                        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
</html>
