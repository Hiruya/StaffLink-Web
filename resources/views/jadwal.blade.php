<x-layouts.app title="Jadwal">
    <div class="p-6">
        <h1 class="text-2xl font-semibold mb-4">Daftar Jadwal</h1>

        <div class="overflow-x-auto bg-white dark:bg-neutral-800 rounded-lg shadow">
            <table id="jadwal-table" class="min-w-full text-sm text-left text-gray-600 dark:text-gray-300">
                <thead class="bg-gray-100 dark:bg-neutral-700 text-xs uppercase">
                    <tr>
                        <th class="px-4 py-3">Nama</th>
                        <th class="px-4 py-3">Jam Masuk</th>
                        <th class="px-4 py-3">Jam Keluar</th>
                        <th class="px-4 py-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($jadwals as $jadwal)
                        <tr class="hover:bg-gray-50 dark:hover:bg-neutral-700">
                            <td class="px-4 py-3">{{ $jadwal->user->name ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $jadwal->jam_masuk }}</td>
                            <td class="px-4 py-3">{{ $jadwal->jam_keluar }}</td>
                            <td class="px-4 py-3 space-x-2">
                                <a href="{{ route('jadwal.edit', $jadwal->id) }}" class="text-blue-600 hover:underline text-xs">Edit</a>
                                <form action="{{ route('jadwal.destroy', $jadwal->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin hapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline text-xs">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-gray-400">Tidak ada data jadwal.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- DataTables CDN -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function () {
            // $('#jadwal-table').DataTable();
        });
    </script>
@endpush