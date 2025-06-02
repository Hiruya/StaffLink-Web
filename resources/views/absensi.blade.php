<x-layouts.app title="Dashboard">
    <div 
        x-data="{ modalType: '', selectedId: null }" 
        class="relative h-full flex-1 overflow-x-auto rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 p-4"
    >
        <div class="container mx-auto p-4">

            <!-- Tambahkan Judul di sini -->
            <h2 class="text-2xl font-bold text-neutral-800 dark:text-white mb-4">Absensi Karyawan</h2>

            <table id="absensi-table" class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                         <th>Departemen</th>
                        <th>Tanggal</th>
                        <th>Waktu Masuk</th>
                        <th>Waktu Pulang</th>
                        <th>Waktu Kerja</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                     @foreach ($absensi as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->user->name ?? '-' }}</td>
                            <td>{{ $item->departemen }}</td>
                            <td>{{ $item->tanggal }}</td>
                            <td>{{ $item->waktu_masuk ?? '-' }}</td>
                            <td>{{ $item->waktu_keluar ?? '-' }}</td>
                            <td>{{ $item->durasi }}</td>
                            <td>{{ $item->keterangan ?? '-' }}</td>
                        
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="flex justify-end mt-4 gap-4">
                <button type="button" onclick="downloadPdf()" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition relative z-10">
    Download
</button>

            </div>

        </div>
        

        @push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <!-- Tambahkan jsPDF dan jsPDF-AutoTable -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#absensi-table').DataTable();
        });

        // Fungsi buat generate PDF dari tabel
        function downloadPdf() {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();

            doc.autoTable({ 
                html: '#absensi-table',
                styles: { fontSize: 8 },
                headStyles: { fillColor: [22, 160, 133] },
                theme: 'striped',
                margin: { top: 10 }
            });

            doc.save('laporan-absensi.pdf');
        }
    </script>
@endpush

    </div>
</x-layouts.app>
