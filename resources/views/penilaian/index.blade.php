<x-layouts.app title="Penilaian Karyawan">
    <div class="p-4">
        <h1 class="text-xl font-semibold mb-4">Form Penilaian</h1>

        {{-- Form Penilaian --}}
        <form action="{{ route('penilaian.store') }}" method="POST" class="mb-6">
            @csrf
            <input name="kompetensi" class="border p-2 w-full mb-2" placeholder="Kompetensi" required>
            <input name="metode" class="border p-2 w-full mb-2" placeholder="Metode" required>
            <input type="number" name="target" class="border p-2 w-full mb-2" value="4" min="1" max="4" required>

            <select name="aktual" class="border p-2 w-full mb-2" required>
                <option value="">Pilih Nilai Aktual</option>
                @for ($i = 1; $i <= 4; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>

            <textarea name="komentar" class="border p-2 w-full mb-2" placeholder="Komentar"></textarea>

            <button class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
        </form>

        {{-- Tabel Data Penilaian --}}
        <table class="min-w-full border border-collapse">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border px-4 py-2">Kompetensi</th>
                    <th class="border px-4 py-2">Metode</th>
                    <th class="border px-4 py-2">Target</th>
                    <th class="border px-4 py-2">Aktual</th>
                    <th class="border px-4 py-2">Hasil × Bobot</th>
                    <th class="border px-4 py-2">Gap</th>
                    <th class="border px-4 py-2">Komentar</th>
                </tr>
            </thead>
            <tbody>
                @forelse($penilaians as $item)
                    <tr>
                        <td class="border px-4 py-2">{{ $item->kompetensi }}</td>
                        <td class="border px-4 py-2">{{ $item->metode }}</td>
                        <td class="border px-4 py-2">{{ $item->target }}</td>
                        <td class="border px-4 py-2">{{ $item->aktual }}</td>
                        <td class="border px-4 py-2">{{ $item->hasil_bobot }}</td>
                        <td class="border px-4 py-2">{{ $item->gap }}</td>
                        <td class="border px-4 py-2">{{ $item->komentar }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center p-4">Belum ada data penilaian.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-layouts.app>
