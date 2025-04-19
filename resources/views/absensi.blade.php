<x-layouts.app title="Dashboard">
    <div class="relative h-full flex-1 overflow-x-auto rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 p-4">
 {{-- Container utama untuk isi dashboard --}}
        <div class="container mx-auto p-4">
    {{-- Tombol Download --}}
<div class="mb-4">
    <a href="{{ route('absensi.download') }}" class="inline-block bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
        Download PDF
    </a>
</div>


        {{-- Tabel Absensi --}}
        <table id="absensi-table" class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead>
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-800 dark:text-gray-100">No</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-800 dark:text-gray-100">Nama</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-800 dark:text-gray-100">Tanggal</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-800 dark:text-gray-100">Waktu Masuk</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-800 dark:text-gray-100">Waktu Keluar</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-800 dark:text-gray-100">Lokasi Masuk</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-800 dark:text-gray-100">Lokasi Keluar</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-800 dark:text-gray-100">Waktu Kerja</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($absensi as $item)
                    @php
                        $masuk = \Carbon\Carbon::parse($item->waktu_masuk);
                        $keluar = $item->waktu_keluar ? \Carbon\Carbon::parse($item->waktu_keluar) : null;
                        $durasi = $keluar ? $masuk->diff($keluar)->format('%H:%I:%S') : '-';
                    @endphp
                    <tr>
                        <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-100">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-100">{{ $item->user->name ?? '-' }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-100">{{ $item->tanggal }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-100">{{ $item->waktu_masuk }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-100">{{ $item->waktu_keluar ?? '-' }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-100">{{ $item->lokasi_masuk }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-100">{{ $item->lokasi_keluar ?? '-' }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-100">{{ $durasi }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready(function () {
                $('#absensi-table').DataTable();
            });
        </script>
    @endpush
</x-layouts.app>
