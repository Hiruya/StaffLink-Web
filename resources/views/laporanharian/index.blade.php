<x-layouts.app title="Laporan Harian">
    <div class="p-6">
        <div class="flex items-center justify-between mb-4">
            <h1 class="text-2xl font-semibold">Laporan Pekerjaan Harian</h1>
            <a href="{{ route('laporanharian.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Tambah
            </a>
        </div>

        <div class="overflow-x-auto bg-white dark:bg-neutral-800 rounded-lg shadow" id="print-area">
            <table id="laporan-table" class="min-w-full table-auto text-sm text-left text-gray-600 dark:text-gray-300" style="table-layout: fixed;">
                <thead class="bg-gray-100 dark:bg-neutral-700 text-xs uppercase">
                    <tr>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3">Tanggal</th>
                        <th class="px-4 py-3">Nama</th>
                        <th class="px-4 py-3">Departemen</th>
                        <th class="px-4 py-3">Shift</th>
                        <th class="px-4 py-3">Jam Kerja</th>
                        <th class="px-4 py-3">Pelayanan</th>
                        <th class="px-4 py-3">Dokumentasi</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($laporans as $laporan)
                        <tr class="hover:bg-gray-50 dark:hover:bg-neutral-700 align-top">
                            <td class="px-4 py-2 break-words">{{ $laporan->email }}</td>
                            <td class="px-4 py-2">{{ \Carbon\Carbon::parse($laporan->tanggal)->format('d-m-Y') }}</td>
                            <td class="px-4 py-2">{{ $laporan->nama }}</td>
                            <td class="px-4 py-2">{{ $laporan->departemen }}</td>
                            <td class="px-4 py-2">{{ $laporan->shift }}</td>
                            <td class="px-4 py-2">{{ $laporan->jam_kerja }}</td>
                            <td class="px-4 py-2 max-w-xs break-words">
                            @if(!empty($laporan->pelayanan))
                                {{ is_array($laporan->pelayanan) ? implode(', ', $laporan->pelayanan) : $laporan->pelayanan }}
                            @else
                                <span class="text-gray-400 italic">-</span>
                            @endif
                        </td>

                            <td class="px-4 py-2 max-w-xs break-words">
    @php
    $docs = $laporan->dokumentasi;
    if (is_string($docs)) {
        $docs = json_decode($docs, true);
    }
@endphp

@if (is_array($docs) && count($docs) > 0)
    @foreach ($docs as $dok)
        @if ($dok)
            <a href="{{ asset('storage/' . $dok) }}" target="_blank" class="text-blue-600 hover:underline">Lihat</a><br>
        @endif
    @endforeach
@else
    <span class="text-gray-400 italic">-</span>
@endif

</td>
                            <td class="px-4 py-2 space-x-2 whitespace-nowrap">
                                <a href="{{ route('laporanharian.edit', $laporan->id) }}" class="text-blue-600 hover:underline text-xs">Edit</a>
                                <form action="{{ route('laporanharian.destroy', $laporan->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin hapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline text-xs">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-4 text-gray-400">Tidak ada data laporan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="flex justify-end mt-4">
            <button type="button" onclick="downloadPdf()" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition relative z-10">
                Download
            </button>
        </div>

    @push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#laporan-table').DataTable();
        });

        function downloadPdf() {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();

            doc.autoTable({ 
                html: '#laporan-table',
                styles: { fontSize: 8 },
                headStyles: { fillColor: [22, 160, 133] },
                theme: 'striped',
                margin: { top: 10 }
            });

            doc.save('laporan-harian.pdf');
        }
    </script>
    @endpush
    </div>
</x-layouts.app>
