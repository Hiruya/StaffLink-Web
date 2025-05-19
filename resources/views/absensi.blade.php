<x-layouts.app title="Dashboard">
    <div 
        x-data="{ modalType: '', selectedId: null }" 
        class="relative h-full flex-1 overflow-x-auto rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 p-4"
    >
        <div class="container mx-auto p-4">
            {{-- Tabel Absensi --}}
            <table id="absensi-table" class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Waktu Masuk</th>
                        <th>Waktu Pulang</th>
                        <th>Waktu Kerja</th>
                        <th>Keterangan</th>
                        <th>Action</th>
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
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->user->name ?? '-' }}</td>
                            <td>{{ $item->tanggal }}</td>
                            <td>{{ $item->waktu_masuk }}</td>
                            <td>{{ $item->waktu_keluar ?? '-' }}</td>
                            <td>{{ $durasi }}</td>
                            <td>{{ $item->keterangan ?? '-' }}</td>

                            <td>
                                <button @click="modalType = 'view'; selectedId = {{ $item->id }}" class="text-blue-600 hover:underline">View</button> |
                                <button @click="modalType = 'edit'; selectedId = {{ $item->id }}" class="text-yellow-500 hover:underline">Edit</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="flex justify-end mt-4 gap-4">
                <button type="button" onclick="printTable()" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition relative z-10">
                    Download / Print
                </button>
            </div>

        </div>
        
        <!-- Media Print CSS -->
        <style>
            @media print {
                body * {
                    visibility: hidden;
                }
                #absensi-table, #absensi-table * {
                    visibility: visible;
                }
                #absensi-table {
                    position: absolute;
                    left: 0;
                    top: 0;
                    width: 100%;
                }
            }
        </style>

        @push('scripts')
            <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
            <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
            <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
            <script>
                $(document).ready(function () {
                    $('#absensi-table').DataTable();
                });

                function printTable() {
                    window.print();
                }
            </script>
        @endpush
    </div>
</x-layouts.app>
