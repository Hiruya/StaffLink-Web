<x-layouts.app title="Dashboard">
    <div 
        x-data="{ modalType: '', selectedId: null }" 
        class="relative h-full flex-1 overflow-x-auto rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 p-4"
    >
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
                        <th>No</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Waktu Masuk</th>
                        <th>Waktu Keluar</th>
                        <th>Lokasi Masuk</th>
                        <th>Lokasi Keluar</th>
                        <th>Waktu Kerja</th>
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
                            <td>{{ $item->lokasi_masuk }}</td>
                            <td>{{ $item->lokasi_keluar ?? '-' }}</td>
                            <td>{{ $durasi }}</td>
                            <td>
                                <button @click="modalType = 'view'; selectedId = {{ $item->id }}" class="text-blue-600 hover:underline">View</button> |
                                <button @click="modalType = 'edit'; selectedId = {{ $item->id }}" class="text-yellow-500 hover:underline">Edit</button>
                            </td>
                        </tr>

                      <!-- View Modal -->
<div 
    x-show="modalType === 'view' && selectedId === {{ $item->id }}"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 scale-95"
    x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-95"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
    style="display: none;"
>
    <div class="bg-white dark:bg-zinc-800 p-6 rounded-xl w-full max-w-lg shadow-lg">
        <h2 class="text-lg font-semibold mb-4">Detail Absensi</h2>
        <p><strong>Nama:</strong> {{ $item->user->name ?? '-' }}</p>
        <p><strong>Tanggal:</strong> {{ $item->tanggal }}</p>
        <p><strong>Masuk:</strong> {{ $item->waktu_masuk }}</p>
        <p><strong>Keluar:</strong> {{ $item->waktu_keluar ?? '-' }}</p>
        <p><strong>Lokasi Masuk:</strong> {{ $item->lokasi_masuk }}</p>
        <p><strong>Lokasi Keluar:</strong> {{ $item->lokasi_keluar ?? '-' }}</p>
        <p><strong>Durasi:</strong> {{ $durasi }}</p>
        <button @click="modalType = ''; selectedId = null" class="mt-4 bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded">Tutup</button>
    </div>
</div>


                        {{-- Edit Modal --}}
                        <div 
                            x-show="modalType === 'edit' && selectedId === {{ $item->id }}" 
                            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
                        >
                            <div class="bg-white dark:bg-zinc-800 p-6 rounded-xl w-full max-w-lg">
                                <h2 class="text-lg font-semibold mb-4">Edit Absensi</h2>
                                <form action="{{ route('absensi.update', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label class="block text-sm font-medium">Waktu Keluar</label>
                                        <input type="datetime-local" name="waktu_keluar" value="{{ $item->waktu_keluar }}" class="w-full px-3 py-2 border rounded">
                                    </div>
                                    <div class="mb-3">
                                        <label class="block text-sm font-medium">Lokasi Keluar</label>
                                        <input type="text" name="lokasi_keluar" value="{{ $item->lokasi_keluar }}" class="w-full px-3 py-2 border rounded">
                                    </div>
                                    <div class="flex justify-end gap-2">
                                        <button type="button" @click="modalType = ''; selectedId = null" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded">Batal</button>
                                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
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
    </div>
</x-layouts.app>
