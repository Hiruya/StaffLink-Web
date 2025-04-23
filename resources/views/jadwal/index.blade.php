<x-layouts.app title="Jadwal">
    <div class="p-6">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-semibold">Daftar Jadwal</h1>
            <div class="space-x-2">
                <a href="{{ route('jadwal.create') }}" class="bg-green-600 text-white px-3 py-2 rounded hover:bg-green-700 text-sm">+ Tambah Jadwal</a>

                <!-- Bulk Delete Form -->
                <form id="bulkDeleteForm" action="{{ route('jadwal.bulk-delete') }}" method="POST" class="inline">
                    @csrf
                    <input type="hidden" name="ids[]" id="selectedIds">
                    <button type="submit" class="bg-red-600 text-white px-3 py-2 rounded hover:bg-red-700 text-sm">
                        Bulk Hapus
                    </button>
                </form>
            </div>
        </div>

        <div class="overflow-x-auto bg-white rounded-lg shadow-md">
            <table id="jadwalTable" class="min-w-full text-sm text-left text-gray-600">
                <thead class="bg-gray-100 uppercase">
                    <tr>
                        <th class="px-4 py-3"><input type="checkbox" id="selectAll"></th>
                        <th class="px-4 py-3">Nama</th>
                        <th class="px-4 py-3">Jam Masuk</th>
                        <th class="px-4 py-3">Jam Keluar</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($jadwals as $jadwal)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2">
                                <input type="checkbox" class="rowCheckbox" value="{{ $jadwal->id }}">
                            </td>
                            <td class="px-4 py-2">{{ $jadwal->user->name ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $jadwal->jam_masuk }}</td>
                            <td class="px-4 py-2">{{ $jadwal->jam_keluar }}</td>
                            <td class="px-4 py-2 space-x-1">
                                <a href="{{ route('jadwal.edit', $jadwal->id) }}" class="bg-blue-500 text-white px-2 py-1 text-xs rounded hover:bg-blue-600">Edit</a>
                                <form action="{{ route('jadwal.destroy', $jadwal->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin hapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-2 py-1 text-xs rounded hover:bg-red-600">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-gray-400 py-4">Tidak ada data jadwal.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @push('scripts')
        <!-- DataTables -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

        <script>
            $(document).ready(function () {
                $('#jadwalTable').DataTable();

                // Select All Checkbox
                $('#selectAll').on('click', function () {
                    $('.rowCheckbox').prop('checked', this.checked);
                });

                // Bulk Delete Handling
                $('#bulkDeleteForm').on('submit', function (e) {
                    const ids = $('.rowCheckbox:checked').map(function () {
                        return $(this).val();
                    }).get();

                    if (ids.length === 0) {
                        e.preventDefault();
                        alert("Pilih minimal satu data untuk dihapus.");
                        return;
                    }

                    $('#selectedIds').val(ids);
                });
            });
        </script>
    @endpush
</x-layouts.app>
