<x-layouts.app title="Laporan Harian">
    <div class="p-6">
        <div class="flex items-center justify-between mb-4">
            <h1 class="text-2xl font-semibold">Rekap Penilaian</h1>
        </div>

        <div class="overflow-x-auto bg-white dark:bg-neutral-800 rounded-lg shadow" id="print-area">
            <table id="laporan-table" class="min-w-full table-auto text-sm text-left text-gray-600 dark:text-gray-300" style="table-layout: fixed;">
                <thead class="bg-gray-100 dark:bg-neutral-700 text-xs uppercase">
                    <tr>
                        <th class="px-4 py-3">Tanggal</th>
                        <th class="px-4 py-3">Nama</th>
                        <th class="px-4 py-3">Departemen</th>
                        <th class="px-4 py-3">Result</th>
                        <th class="px-4 py-3">Score</th>
                        <th class="px-4 py-3">Index</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($laporans as $laporan)
                        <tr class="hover:bg-gray-50 dark:hover:bg-neutral-700 align-top">
                            <td class="px-4 py-2">{{ \Carbon\Carbon::parse($laporan->created_at)->format('d-m-Y') }}</td>
                            <td class="px-4 py-2">{{ $laporan->nama }}</td>
                            <td class="px-4 py-2">{{ $laporan->departemen }}</td>
                            <td class="px-4 py-2">{{ $laporan->total_score }}</td>
                            <td class="px-4 py-2">{{ $laporan->total_persentase }}</td>
                            <td class="px-4 py-2">{{ $laporan->indeks }}</td>
                            <td class="px-4 py-2 space-x-2 whitespace-nowrap">
                                <a href="{{ route('laporanharian.edit', $laporan->id) }}"
                                   class="text-blue-600 hover:underline text-xs">Edit</a>
                                <form action="{{ route('laporanharian.destroy', $laporan->id) }}"
                                      method="POST" class="inline" onsubmit="return confirm('Yakin ingin hapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline text-xs">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-gray-400">Tidak ada data laporan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

       <!-- Tombol Print di kanan bawah -->
<div class="flex justify-end mt-4 space-x-2">
    <a href="{{ route('dashboard') }}"
       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
        Kembali
    </a>
    <button type="button" onclick="printTable()"
            class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
        Download / Print
    </button>
</div>
</x-layouts.app>


@push('scripts')
    <!-- DataTables CSS & JS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#laporan-table').DataTable({
                destroy: true,
                responsive: true,
                columnDefs: [
                    { orderable: false, targets: [6] } // Kolom aksi tidak bisa di-sort
                ],
            });
        });

        function printTable() {
            const printContents = document.getElementById("print-area").innerHTML;
            const originalContents = document.body.innerHTML;

            document.body.innerHTML = `
                <html>
                    <head>
                        <title>Cetak Laporan Harian</title>
                        <style>
                            body { font-family: sans-serif; margin: 20px; }
                            table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                            th, td { border: 1px solid #ccc; padding: 8px; text-align: left; word-wrap: break-word; }
                            th { background-color: #f2f2f2; }
                            h2 { text-align: center; }
                        </style>
                    </head>
                    <body>
                        <h2>Laporan Pekerjaan Harian</h2>
                        ${printContents}
                    </body>
                </html>
            `;
            window.print();

            // Setelah print, reload halaman agar JS dan event kembali normal
            window.location.reload();
        }
    </script>
@endpush
