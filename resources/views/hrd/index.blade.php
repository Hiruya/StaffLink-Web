<x-layouts.app>
<div class="container mx-auto px-4 py-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-zinc-800 dark:text-zinc-100">Data Karyawan</h1>
            <p class="text-zinc-600 dark:text-zinc-400">Daftar seluruh karyawan perusahaan.</p>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-lg shadow dark:bg-zinc-800 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-zinc-500 dark:text-zinc-400">
                    <thead class="text-xs text-zinc-700 uppercase bg-zinc-50 dark:bg-zinc-700 dark:text-zinc-300">
                        <tr>
                            <th scope="col" class="px-6 py-3">ID</th>
                            <th scope="col" class="px-6 py-3">Nama</th>
                            <th scope="col" class="px-6 py-3">Department</th>
                            <th scope="col" class="px-6 py-3">Region</th>
                            <th scope="col" class="px-6 py-3">Usia</th>
                            <th scope="col" class="px-6 py-3">Pelatihan</th>
                            <th scope="col" class="px-6 py-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($karyawans as $karyawan)
                            <tr class="bg-white border-b dark:bg-zinc-800 dark:border-zinc-700 hover:bg-zinc-50 dark:hover:bg-zinc-700">
                                <td class="px-6 py-4 font-medium text-zinc-900 dark:text-white">
                                    {{ $karyawan->employee_id }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $karyawan->name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $karyawan->department }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $karyawan->region }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $karyawan->age }} tahun
                                </td>
                                <td class="px-6 py-4">
                                    {{ $karyawan->no_of_trainings }} kali
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('hrd.show', $karyawan->id) }}"
                                       class="font-medium text-blue-600 hover:text-blue-800 dark:text-blue-500 dark:hover:text-blue-400">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-4 text-center text-zinc-500 dark:text-zinc-400">
                                    Tidak ada data karyawan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($karyawans->hasPages())
                <div class="px-6 py-4 border-t border-zinc-200 dark:border-zinc-700">
                    {{ $karyawans->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
</x-layouts.app>
