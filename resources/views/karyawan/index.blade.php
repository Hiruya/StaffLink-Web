{{-- <x-layouts.app>
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
        <div>
            <h1 class="text-2xl font-bold text-zinc-800 dark:text-zinc-100">Data Karyawan</h1>
            <p class="text-zinc-600 dark:text-zinc-400">Informasi lengkap tentang data karyawan Anda.</p>
        </div>

        @if(!$karyawan)
            <a href="{{ route('karyawan.create') }}"
                class="mt-4 md:mt-0 inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Tambah Data Karyawan
            </a>
        @endif
    </div>

    <!-- Notifications -->
    @if (session('success'))
        <div class="mb-6 px-4 py-3 bg-green-100 text-green-700 rounded-lg dark:bg-green-900 dark:text-green-100">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-6 px-4 py-3 bg-red-100 text-red-700 rounded-lg dark:bg-red-900 dark:text-red-100">
            {{ session('error') }}
        </div>
    @endif

    <!-- Karyawan Data -->
    @if($karyawan)
        <div class="bg-white rounded-lg shadow dark:bg-zinc-800 overflow-hidden">
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Basic Information -->
                    <div class="space-y-4">
                        <h2 class="text-lg font-semibold text-zinc-800 dark:text-zinc-100 border-b pb-2">Informasi Dasar</h2>

                        <div>
                            <p class="text-sm text-zinc-500 dark:text-zinc-400">Employee ID</p>
                            <p class="text-zinc-800 dark:text-zinc-100">{{ $karyawan->employee_id }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-zinc-500 dark:text-zinc-400">Nama Lengkap</p>
                            <p class="text-zinc-800 dark:text-zinc-100">{{ $karyawan->name }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-zinc-500 dark:text-zinc-400">Department</p>
                            <p class="text-zinc-800 dark:text-zinc-100">{{ $karyawan->department }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-zinc-500 dark:text-zinc-400">Region</p>
                            <p class="text-zinc-800 dark:text-zinc-100">{{ $karyawan->region }}</p>
                        </div>
                    </div>

                    <!-- Additional Information -->
                    <div class="space-y-4">
                        <h2 class="text-lg font-semibold text-zinc-800 dark:text-zinc-100 border-b pb-2">Informasi Tambahan</h2>

                        <div>
                            <p class="text-sm text-zinc-500 dark:text-zinc-400">Pendidikan</p>
                            <p class="text-zinc-800 dark:text-zinc-100">{{ $karyawan->education }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-zinc-500 dark:text-zinc-400">Jenis Kelamin</p>
                            <p class="text-zinc-800 dark:text-zinc-100">{{ $karyawan->gender == 'male' ? 'Laki-laki' : 'Perempuan' }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-zinc-500 dark:text-zinc-400">Rekrutmen Channel</p>
                            <p class="text-zinc-800 dark:text-zinc-100">{{ $karyawan->recruitment_channel }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-zinc-500 dark:text-zinc-400">Jumlah Pelatihan</p>
                            <p class="text-zinc-800 dark:text-zinc-100">{{ $karyawan->no_of_trainings }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-zinc-500 dark:text-zinc-400">Usia</p>
                            <p class="text-zinc-800 dark:text-zinc-100">{{ $karyawan->age }} tahun</p>
                        </div>
                    </div>
                </div>

                <!-- User Information -->
                @if($karyawan->user)
                    <div class="mt-8 pt-6 border-t border-zinc-200 dark:border-zinc-700">
                        <h2 class="text-lg font-semibold text-zinc-800 dark:text-zinc-100 mb-4">Informasi Akun</h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <p class="text-sm text-zinc-500 dark:text-zinc-400">Email</p>
                                <p class="text-zinc-800 dark:text-zinc-100">{{ $karyawan->user->email }}</p>
                            </div>

                            <div>
                                <p class="text-sm text-zinc-500 dark:text-zinc-400">Role</p>
                                <p class="text-zinc-800 dark:text-zinc-100">{{ $karyawan->user->role->name ?? 'Tidak ada role' }}</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Actions -->
            <div class="px-6 py-4 bg-zinc-50 dark:bg-zinc-700 flex justify-end space-x-4">
                <a href="{{ route('karyawan.create') }}"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Edit Data
                </a>
            </div>
        </div>
    @else
        <div class="bg-white rounded-lg shadow dark:bg-zinc-800 p-6 text-center">
            <svg class="mx-auto h-12 w-12 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
            </svg>
            <h3 class="mt-2 text-lg font-medium text-zinc-900 dark:text-zinc-100">Belum ada data karyawan</h3>
            <p class="mt-1 text-zinc-500 dark:text-zinc-400">Silakan isi data karyawan Anda terlebih dahulu.</p>
            <div class="mt-6">
                <a href="{{ route('karyawan.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Tambah Data Karyawan
                </a>
            </div>
        </div>
    @endif
</div>
</x-layouts.app> --}}

{{-- <x-layouts.app>
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-zinc-800 dark:text-zinc-100">Data Karyawan Saya</h1>
            <p class="text-zinc-600 dark:text-zinc-400">Berikut adalah data karyawan Anda.</p>
        </div>

        <!-- Employee Card -->
        <div class="bg-white rounded-lg shadow dark:bg-zinc-800 overflow-hidden">
            <!-- Card Header -->
            <div class="bg-blue-600 px-6 py-4">
                <h2 class="text-xl font-semibold text-white">{{ $karyawan->name }}</h2>
                <p class="text-blue-100">{{ $karyawan->employee_id }} • {{ $karyawan->department }}</p>
            </div>

            <!-- Card Body -->
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Personal Info -->
                    <div>
                        <h3 class="text-lg font-medium text-zinc-800 dark:text-zinc-200 mb-4">Informasi Pribadi</h3>
                        <div class="space-y-3">
                            <div>
                                <p class="text-sm text-zinc-500 dark:text-zinc-400">Usia</p>
                                <p class="text-zinc-800 dark:text-zinc-200">{{ $karyawan->age }} tahun</p>
                            </div>
                            <div>
                                <p class="text-sm text-zinc-500 dark:text-zinc-400">Jenis Kelamin</p>
                                <p class="text-zinc-800 dark:text-zinc-200">{{ $karyawan->gender == 'male' ? 'Laki-laki' : 'Perempuan' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-zinc-500 dark:text-zinc-400">Pendidikan</p>
                                <p class="text-zinc-800 dark:text-zinc-200">{{ $karyawan->education }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Work Info -->
                    <div>
                        <h3 class="text-lg font-medium text-zinc-800 dark:text-zinc-200 mb-4">Informasi Pekerjaan</h3>
                        <div class="space-y-3">
                            <div>
                                <p class="text-sm text-zinc-500 dark:text-zinc-400">Region</p>
                                <p class="text-zinc-800 dark:text-zinc-200">{{ $karyawan->region }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-zinc-500 dark:text-zinc-400">Rekrutmen</p>
                                <p class="text-zinc-800 dark:text-zinc-200">{{ $karyawan->recruitment_channel }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-zinc-500 dark:text-zinc-400">Pelatihan</p>
                                <p class="text-zinc-800 dark:text-zinc-200">{{ $karyawan->no_of_trainings }} kali pelatihan</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit Button -->
                <div class="mt-8 pt-6 border-t border-zinc-200 dark:border-zinc-700 flex justify-end">
                    <a href="{{ route('karyawan.edit', $karyawan->id) }}"
                       class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                        Edit Data
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
</x-layouts.app> --}}

<x-layouts.app>
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-zinc-800 dark:text-zinc-100">Data Karyawan Saya</h1>
            <p class="text-zinc-600 dark:text-zinc-400">Berikut adalah data karyawan Anda.</p>
        </div>

        @if(!$karyawan)
            <div class="bg-white rounded-lg shadow dark:bg-zinc-800 overflow-hidden p-6 text-center">
                <p class="text-zinc-600 dark:text-zinc-400 mb-4">Data karyawan tidak ditemukan.</p>
                <a href="{{ route('karyawan.create') }}"
                   class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                    Tambah Data Karyawan
                </a>
            </div>
        @else
            <!-- Employee Card -->
            <div class="bg-white rounded-lg shadow dark:bg-zinc-800 overflow-hidden">
                <!-- Card Header -->
                <div class="bg-blue-600 px-6 py-4">
                    <h2 class="text-xl font-semibold text-white">{{ $karyawan->name }}</h2>
                    <p class="text-blue-100">{{ $karyawan->employee_id }} • {{ $karyawan->department }}</p>
                </div>

                <!-- Card Body -->
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Personal Info -->
                        <div>
                            <h3 class="text-lg font-medium text-zinc-800 dark:text-zinc-200 mb-4">Informasi Pribadi</h3>
                            <div class="space-y-3">
                                <div>
                                    <p class="text-sm text-zinc-500 dark:text-zinc-400">Usia</p>
                                    <p class="text-zinc-800 dark:text-zinc-200">{{ $karyawan->age }} tahun</p>
                                </div>
                                <div>
                                    <p class="text-sm text-zinc-500 dark:text-zinc-400">Jenis Kelamin</p>
                                    <p class="text-zinc-800 dark:text-zinc-200">{{ $karyawan->gender == 'male' ? 'Laki-laki' : 'Perempuan' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-zinc-500 dark:text-zinc-400">Pendidikan</p>
                                    <p class="text-zinc-800 dark:text-zinc-200">{{ $karyawan->education }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Work Info -->
                        <div>
                            <h3 class="text-lg font-medium text-zinc-800 dark:text-zinc-200 mb-4">Informasi Pekerjaan</h3>
                            <div class="space-y-3">
                                <div>
                                    <p class="text-sm text-zinc-500 dark:text-zinc-400">Region</p>
                                    <p class="text-zinc-800 dark:text-zinc-200">{{ $karyawan->region }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-zinc-500 dark:text-zinc-400">Rekrutmen</p>
                                    <p class="text-zinc-800 dark:text-zinc-200">{{ $karyawan->recruitment_channel }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-zinc-500 dark:text-zinc-400">Pelatihan</p>
                                    <p class="text-zinc-800 dark:text-zinc-200">{{ $karyawan->no_of_trainings }} kali pelatihan</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Button -->
                    <div class="mt-8 pt-6 border-t border-zinc-200 dark:border-zinc-700 flex justify-end">
                        <a href="{{ route('karyawan.edit', $karyawan->id) }}"
                           class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                            Edit Data
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
</x-layouts.app>
