<x-layouts.app>
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-zinc-800 dark:text-zinc-100">Detail Karyawan</h1>
            <p class="text-zinc-600 dark:text-zinc-400">Informasi lengkap karyawan.</p>
        </div>

        <!-- Employee Card -->
        <div class="bg-white rounded-lg shadow dark:bg-zinc-800 overflow-hidden">
            <!-- Card Header -->
            <div class="bg-blue-600 px-6 py-4">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-xl font-semibold text-white">{{ $karyawan->name }}</h2>
                        <p class="text-blue-100">{{ $karyawan->employee_id }} • {{ $karyawan->department }}</p>
                    </div>
                    <div class="text-blue-200">
                        {{ $karyawan->user->email }}
                    </div>
                </div>
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

                <!-- Back Button -->
                <div class="mt-8 pt-6 border-t border-zinc-200 dark:border-zinc-700">
                    <a href="{{ route('hrd.index') }}"
                       class="px-4 py-2 bg-zinc-600 text-white rounded hover:bg-zinc-700 transition">
                        Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
</x-layouts.app>
