{{-- <x-layouts.app title="Penilaian Kompetensi">
@php
$kompetensi = [
    ['Kategori' => 'Skill 35%', 'Kompetensi' => 'Kepemimpinan / Leadership'],
    ['Kategori' => '', 'Kompetensi' => 'Penyusunan Rencana & Strategi / Management Planning'],
    ['Kategori' => '', 'Kompetensi' => 'Analisa dan Penyelesaian Masalah / Analytical Thinking & Problem Solving'],
    ['Kategori' => '', 'Kompetensi' => 'Pengambilan Keputusan / Decision Making'],
    ['Kategori' => '', 'Kompetensi' => 'Kemampuan Presentasi / Presentation Skill'],
    ['Kategori' => '', 'Kompetensi' => 'Kerja sama tim / Teamwork'],
    ['Kategori' => '', 'Kompetensi' => 'Kemampuan Negosiasi / Negotiation Skills'],
    ['Kategori' => '', 'Kompetensi' => 'Kemampuan Pengembangan & pembelajaran / Learning skills'],
    ['Kategori' => '', 'Kompetensi' => 'Fokus Pelanggan / Customer Focus'],
    ['Kategori' => '', 'Kompetensi' => 'Orientasi pada kualitas kerja / Quality Orientation'],
    ['Kategori' => 'Kinerja 35%', 'Kompetensi' => 'Pencapaian Target Revenue'],
    ['Kategori' => '', 'Kompetensi' => 'Pertumbuhan pendapatan dan profitabilitas'],
    ['Kategori' => '', 'Kompetensi' => 'Inovasi kepemimpinan'],
    ['Kategori' => '', 'Kompetensi' => 'Pemeliharaan dan keamanan properti'],
    ['Kategori' => '', 'Kompetensi' => 'Kepuasan karyawan dan tamu'],
    ['Kategori' => 'Attitude 30%', 'Kompetensi' => 'Empati / Empathy'],
    ['Kategori' => '', 'Kompetensi' => 'Inisiatif'],
    ['Kategori' => '', 'Kompetensi' => 'Pelaksanaan 6K'],
    ['Kategori' => '', 'Kompetensi' => 'Kehadiran / Attendance'],
    ['Kategori' => '', 'Kompetensi' => 'Kedisiplinan / Discipline'],
];

$kategori_bobot = [
    'Skill 35%' => 4,
    'Kinerja 35%' => 3,
    'Attitude 30%' => 3,
];
@endphp

<div class="max-w-7xl mx-auto p-6 bg-white dark:bg-zinc-900 shadow-md rounded-lg overflow-x-auto">
    <h1 class="text-2xl font-semibold text-zinc-900 dark:text-white mb-4">Penilaian Kompetensi</h1>

    <form method="POST" action="{{ route('penilaian.store') }}">
        @csrf

        <div id="print-area">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div>
                    <label for="nama" class="block text-sm font-medium text-zinc-700 dark:text-zinc-200 mb-1">Nama</label>
                    <input type="text" name="nama" id="nama" class="w-full px-3 py-2 rounded-md border border-zinc-300 dark:border-zinc-600 dark:bg-zinc-800 dark:text-white" required>
                </div>
                <div>
                    <label for="divisi" class="block text-sm font-medium text-zinc-700 dark:text-zinc-200 mb-1">Departemen</label>
                    <input type="text" name="divisi" id="divisi" class="w-full px-3 py-2 rounded-md border border-zinc-300 dark:border-zinc-600 dark:bg-zinc-800 dark:text-white" required>
                </div>
            </div>

            <table class="w-full text-sm text-center border border-zinc-200 dark:border-zinc-700 mb-6">
                <thead>
                    <tr class="bg-blue-700 text-white">
                        <th class="p-3">No</th>
                        <th class="p-3">Kategori</th>
                        <th class="text-left p-3">Kompetensi</th>
                        <th class="p-3">Metode</th>
                        <th class="p-3">Target</th>
                        <th class="p-3">Aktual (1–4)</th>
                        <th class="p-3">Hasil × Bobot</th>
                        <th class="p-3">Gap</th>
                        <th class="p-3">Komentar</th>
                    </tr>
                </thead>
                <tbody>
                    @php $kategori_sekarang = ''; @endphp
                    @foreach ($kompetensi as $i => $item)
                        @php
                            if ($item['Kategori'] !== '') {
                                $kategori_sekarang = $item['Kategori'];
                            }
                            $bobot = $kategori_bobot[$kategori_sekarang] ?? 0;
                        @endphp
                        <tr class="even:bg-zinc-50 dark:even:bg-zinc-800">
                            <td class="p-2">{{ $i + 1 }}</td>
                            <td class="p-2">{{ $item['Kategori'] }}</td>
                            <td class="p-2 text-left">{{ $item['Kompetensi'] }}</td>
                            <td class="p-2">
                                <select name="metode[{{ $i }}]" class="w-full px-2 py-1 border rounded-md dark:bg-zinc-800 dark:border-zinc-600 dark:text-white">
                                    <option value="Observation">Observation</option>
                                    <option value="Job assignment">Job assignment</option>
                                    <option value="Project assignment">Project assignment</option>
                                    <option value="Recording">Recording</option>
                                </select>
                            </td>
                            <td class="p-2">
                                <input type="number" name="target[{{ $i }}]" value="4" readonly class="w-full text-center border rounded-md px-2 py-1 dark:bg-zinc-800 dark:border-zinc-600 dark:text-white">
                            </td>
                            <td class="p-2">
                                <div class="flex justify-center gap-1 radio-group" data-index="{{ $i }}" data-bobot="{{ $bobot }}">
                                    @for ($j = 0; $j <= 4; $j++)
                                        <label class="flex items-center gap-1">
                                            <input type="radio" name="aktual[{{ $i }}]" value="{{ $j }}" class="aktual-radio" {{ $j === 0 ? 'checked' : '' }}>
                                            {{ $j }}
                                        </label>
                                    @endfor
                                </div>
                            </td>
                            <td class="p-2">
                                <input type="text" class="hasil-input w-full text-center border rounded-md px-2 py-1 dark:bg-zinc-800 dark:border-zinc-600 dark:text-white" readonly value="0">
                            </td>
                            <td class="p-2">
                                <input type="text" class="gap-input w-full text-center border rounded-md px-2 py-1 dark:bg-zinc-800 dark:border-zinc-600 dark:text-white" readonly value="0">
                            </td>
                            <td class="p-2">
                                <input type="text" name="komentar[{{ $i }}]" class="w-full border rounded-md px-2 py-1 dark:bg-zinc-800 dark:border-zinc-600 dark:text-white">
                            </td>
                        </tr>

                        @if ($i === 9)
                            <tr class="font-semibold">
                                <td colspan="6" class="text-right p-2">Skill (35%)</td>
                                <td id="total-skill" class="text-center p-2">0</td>
                                <td colspan="2"></td>
                            </tr>
                        @elseif ($i === 14)
                            <tr class="font-semibold">
                                <td colspan="6" class="text-right p-2">Kinerja (35%)</td>
                                <td id="total-kinerja" class="text-center p-2">0</td>
                                <td colspan="2"></td>
                            </tr>
                        @elseif ($i === 19)
                            <tr class="font-semibold">
                                <td colspan="6" class="text-right p-2">Attitude (30%)</td>
                                <td id="total-attitude" class="text-center p-2">0</td>
                                <td colspan="2"></td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>

            <div class="flex flex-wrap gap-4 justify-start text-sm mt-6">
                <div class="w-80 flex border dark:border-white rounded overflow-hidden">
                    <div class="bg-cyan-500 text-white font-bold w-1/2 text-center py-6 text-lg">Result</div>
                    <div class="w-1/2 text-center flex items-center justify-center font-semibold text-lg bg-white dark:bg-zinc-800" id="result-persentase">0%</div>
                    <!-- Hasil Akhir yang ikut dicetak dan disimpan -->
            <div class="flex flex-wrap gap-6 mt-10 text-sm text-center">
                <div class="border border-black flex w-80">
                    <div class="bg-cyan-500 text-white font-bold w-1/2 py-8 text-lg">Result</div>
                    <div class="flex items-center justify-center w-1/2 italic font-semibold text-xl" id="result-persentase">0%</div>
                </div>
                <div class="w-80 flex border dark:border-white rounded overflow-hidden">
                    <div class="bg-cyan-500 text-white font-bold w-1/2 text-center py-6 text-lg">Score</div>
                    <div class="w-1/2 text-center flex items-center justify-center font-semibold text-lg bg-white dark:bg-zinc-800" id="result-score">0</div>
                </div>
                <div class="w-80 flex border dark:border-white rounded overflow-hidden">
                    <div class="bg-cyan-500 text-white font-bold w-1/2 text-center py-6 text-lg">Indeks</div>
                    <div class="w-1/2 text-center flex items-center justify-center text-2xl font-bold text-blue-700 bg-white dark:bg-zinc-800" id="result-indeks">-</div>
                </div>
            </div>

            <!-- Hidden input untuk disimpan ke database -->
            <input type="hidden" name="total_score" id="input-score">
            <input type="hidden" name="total_persentase" id="input-persentase">
            <input type="hidden" name="indeks" id="input-indeks">


        <div class="flex justify-end gap-4 mt-4 no-print">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded text-xs font-semibold hover:bg-blue-700 uppercase tracking-wider">Simpan</button>
            <button type="button" onclick="printTable()" class="bg-green-600 text-white px-4 py-2 rounded text-xs font-semibold hover:bg-green-700 uppercase tracking-wider">Download / Print</button>
            <button type="button" onclick="resetAktual()" class="bg-gray-600 text-white px-4 py-2 rounded text-xs font-semibold hover:bg-gray-700 uppercase tracking-wider">Reset Nilai</button>
        </div>
    </form>
</div>

<script>
function setDefaultMetode() {
    const mapping = {
        "Penyusunan Rencana & Strategi / Management Planning": "Project assignment",
        "Analisa dan Penyelesaian Masalah / Analytical Thinking & Problem Solving": "Job assignment",
        "Orientasi pada kualitas kerja / Quality Orientation": "Job assignment",
        "Pertumbuhan pendapatan dan profitabilitas": "Job assignment",
        "Pencapaian Target Revenue": "Job assignment",
        "Inovasi kepemimpinan": "Job assignment",
        "Pemeliharaan dan keamanan properti": "Job assignment",
        "Kepuasan karyawan dan tamu": "Job assignment",
        "Kehadiran / Attendance": "Recording",
        "Kedisiplinan / Discipline": "Recording"
    };

    document.querySelectorAll('table tbody tr').forEach(row => {
        const kompetensiCell = row.children[2];
        const metodeSelect = row.querySelector('select[name^="metode"]');

        if (!kompetensiCell || !metodeSelect) return;

        const kompetensiText = kompetensiCell.textContent.trim();
        const metode = mapping[kompetensiText];

        if (metode) {
            metodeSelect.value = metode;
        }
    });
}

function updateHasilBobot() {
    let totalSkill = 0, totalKinerja = 0, totalAttitude = 0;

    document.querySelectorAll('.radio-group').forEach(group => {
        const idx = parseInt(group.dataset.index);
        const bobot = parseInt(group.dataset.bobot) || 0;
        const selectedRadio = group.querySelector('input[type="radio"]:checked');
        const val = selectedRadio ? parseInt(selectedRadio.value) : 0;
        const gap = 4 - val;
        const hasil = val * bobot;
    <script>
    function updateHasilBobot() {
        let totalSkill = 0, totalKinerja = 0, totalAttitude = 0;
        document.querySelectorAll('.aktual').forEach(select => {
            const val = parseInt(select.value) || 0;
            const bobot = parseInt(select.dataset.bobot) || 0;
            const idx = parseInt(select.dataset.index);
            const gap = 4 - val;
            const hasil = val * bobot;

        const row = group.closest('tr');
        const hasilInput = row.querySelector('.hasil-input');
        const gapInput = row.querySelector('.gap-input');

        hasilInput.value = hasil;
        gapInput.value = gap;
        highlightChange(hasilInput);
        highlightChange(gapInput);
            const row = select.closest('tr');
            row.querySelector('.hasil-input').value = hasil;
            row.querySelector('.gap-input').value = gap;

            if (idx <= 9) totalSkill += hasil;
            else if (idx <= 14) totalKinerja += hasil;
            else totalAttitude += hasil;
        });

    const total = totalSkill + totalKinerja + totalAttitude;
    const max = 280;
    const persen = ((total / max) * 100).toFixed(0);

    document.getElementById('result-score').textContent = total;
    document.getElementById('result-persentase').textContent = persen + '%';
        const total = totalSkill + totalKinerja + totalAttitude;
        const max = 20 * 4 * 4;
        const persen = ((total / max) * 100).toFixed(0);

        let indeks = '-';
        if (total >= 211) indeks = 'S';
        else if (total >= 141) indeks = 'A';
        else if (total >= 71) indeks = 'B';
        else if (total >= 10) indeks = 'C';

    document.getElementById('result-indeks').textContent = indeks;
}

function highlightChange(input) {
    input.classList.add('bg-yellow-100', 'dark:bg-yellow-900');
    setTimeout(() => input.classList.remove('bg-yellow-100', 'dark:bg-yellow-900'), 500);
}
        // Tampilkan ke UI
        document.getElementById('total-skill').textContent = totalSkill;
        document.getElementById('total-kinerja').textContent = totalKinerja;
        document.getElementById('total-attitude').textContent = totalAttitude;
        document.getElementById('result-score').textContent = total;
        document.getElementById('result-persentase').textContent = persen + '%';
        document.getElementById('result-indeks').textContent = indeks;

        // Simpan ke input hidden untuk dikirim ke server
        document.getElementById('input-score').value = total;
        document.getElementById('input-persentase').value = persen;
        document.getElementById('input-indeks').value = indeks;
    }

    function printTable() {
        window.print();
    }

function resetAktual() {
    document.querySelectorAll('.aktual-radio[value="0"]').forEach(radio => radio.checked = true);
    updateHasilBobot();
}

document.querySelectorAll('.aktual-radio').forEach(radio => {
    radio.addEventListener('change', function () {
        const val = parseInt(this.value);
        if (val < 0 || val > 4) {
            alert("Nilai aktual hanya boleh antara 0–4");
            this.checked = false;
        } else {
            updateHasilBobot();
        }
    });
});

window.addEventListener('load', () => {
    updateHasilBobot();
    setDefaultMetode();
});
</script>
    document.querySelectorAll('.aktual').forEach(select => {
        select.addEventListener('change', updateHasilBobot);
    });
    window.addEventListener('load', updateHasilBobot);
    </script>
</x-layouts.app> --}}

<x-layouts.app title="Penilaian Kompetensi">
@php
$kompetensi = [
    ['Kategori' => 'Skill 35%', 'Kompetensi' => 'Kepemimpinan / Leadership'],
    ['Kategori' => '', 'Kompetensi' => 'Penyusunan Rencana & Strategi / Management Planning'],
    ['Kategori' => '', 'Kompetensi' => 'Analisa dan Penyelesaian Masalah / Analytical Thinking & Problem Solving'],
    ['Kategori' => '', 'Kompetensi' => 'Pengambilan Keputusan / Decision Making'],
    ['Kategori' => '', 'Kompetensi' => 'Kemampuan Presentasi / Presentation Skill'],
    ['Kategori' => '', 'Kompetensi' => 'Kerja sama tim / Teamwork'],
    ['Kategori' => '', 'Kompetensi' => 'Kemampuan Negosiasi / Negotiation Skills'],
    ['Kategori' => '', 'Kompetensi' => 'Kemampuan Pengembangan & pembelajaran / Learning skills'],
    ['Kategori' => '', 'Kompetensi' => 'Fokus Pelanggan / Customer Focus'],
    ['Kategori' => '', 'Kompetensi' => 'Orientasi pada kualitas kerja / Quality Orientation'],
    ['Kategori' => 'Kinerja 35%', 'Kompetensi' => 'Pencapaian Target Revenue'],
    ['Kategori' => '', 'Kompetensi' => 'Pertumbuhan pendapatan dan profitabilitas'],
    ['Kategori' => '', 'Kompetensi' => 'Inovasi kepemimpinan'],
    ['Kategori' => '', 'Kompetensi' => 'Pemeliharaan dan keamanan properti'],
    ['Kategori' => '', 'Kompetensi' => 'Kepuasan karyawan dan tamu'],
    ['Kategori' => 'Attitude 30%', 'Kompetensi' => 'Empati / Empathy'],
    ['Kategori' => '', 'Kompetensi' => 'Inisiatif'],
    ['Kategori' => '', 'Kompetensi' => 'Pelaksanaan 6K'],
    ['Kategori' => '', 'Kompetensi' => 'Kehadiran / Attendance'],
    ['Kategori' => '', 'Kompetensi' => 'Kedisiplinan / Discipline'],
];

$kategori_bobot = [
    'Skill 35%' => 4,
    'Kinerja 35%' => 3,
    'Attitude 30%' => 3,
];
@endphp

<div class="max-w-7xl mx-auto p-6 bg-white dark:bg-zinc-900 shadow-md rounded-lg overflow-x-auto">
    <h1 class="text-2xl font-semibold text-zinc-900 dark:text-white mb-4">Penilaian Kompetensi</h1>

    <form method="POST" action="{{ route('penilaian.store') }}">
        @csrf

        <div id="print-area">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div>
                    <label for="nama" class="block text-sm font-medium text-zinc-700 dark:text-zinc-200 mb-1">Nama</label>
                    <input type="text" name="nama" id="nama" class="w-full px-3 py-2 rounded-md border border-zinc-300 dark:border-zinc-600 dark:bg-zinc-800 dark:text-white" required>
                </div>
                <div>
                    <label for="divisi" class="block text-sm font-medium text-zinc-700 dark:text-zinc-200 mb-1">Departemen</label>
                    <input type="text" name="divisi" id="divisi" class="w-full px-3 py-2 rounded-md border border-zinc-300 dark:border-zinc-600 dark:bg-zinc-800 dark:text-white" required>
                </div>
            </div>

            <table class="w-full text-sm text-center border border-zinc-200 dark:border-zinc-700 mb-6">
                <thead>
                    <tr class="bg-blue-700 text-white">
                        <th class="p-3">No</th>
                        <th class="p-3">Kategori</th>
                        <th class="text-left p-3">Kompetensi</th>
                        <th class="p-3">Metode</th>
                        <th class="p-3">Target</th>
                        <th class="p-3">Aktual (1–4)</th>
                        <th class="p-3">Hasil × Bobot</th>
                        <th class="p-3">Gap</th>
                        <th class="p-3">Komentar</th>
                    </tr>
                </thead>
                <tbody>
                    @php $kategori_sekarang = ''; @endphp
                    @foreach ($kompetensi as $i => $item)
                        @php
                            if ($item['Kategori'] !== '') {
                                $kategori_sekarang = $item['Kategori'];
                            }
                            $bobot = $kategori_bobot[$kategori_sekarang] ?? 0;
                        @endphp
                        <tr class="even:bg-zinc-50 dark:even:bg-zinc-800">
                            <td class="p-2">{{ $i + 1 }}</td>
                            <td class="p-2">{{ $item['Kategori'] }}</td>
                            <td class="p-2 text-left">{{ $item['Kompetensi'] }}</td>
                            <td class="p-2">
                                <select name="metode[{{ $i }}]" class="w-full px-2 py-1 border rounded-md dark:bg-zinc-800 dark:border-zinc-600 dark:text-white">
                                    <option value="Observation">Observation</option>
                                    <option value="Job assignment">Job assignment</option>
                                    <option value="Project assignment">Project assignment</option>
                                    <option value="Recording">Recording</option>
                                </select>
                            </td>
                            <td class="p-2">
                                <input type="number" name="target[{{ $i }}]" value="4" readonly class="w-full text-center border rounded-md px-2 py-1 dark:bg-zinc-800 dark:border-zinc-600 dark:text-white">
                            </td>
                            <td class="p-2">
                                <div class="flex justify-center gap-1 radio-group" data-index="{{ $i }}" data-bobot="{{ $bobot }}">
                                    @for ($j = 0; $j <= 4; $j++)
                                        <label class="flex items-center gap-1">
                                            <input type="radio" name="aktual[{{ $i }}]" value="{{ $j }}" class="aktual-radio" {{ $j === 0 ? 'checked' : '' }}>
                                            {{ $j }}
                                        </label>
                                    @endfor
                                </div>
                            </td>
                            <td class="p-2">
                                <input type="text" class="hasil-input w-full text-center border rounded-md px-2 py-1 dark:bg-zinc-800 dark:border-zinc-600 dark:text-white" readonly value="0">
                            </td>
                            <td class="p-2">
                                <input type="text" class="gap-input w-full text-center border rounded-md px-2 py-1 dark:bg-zinc-800 dark:border-zinc-600 dark:text-white" readonly value="0">
                            </td>
                            <td class="p-2">
                                <input type="text" name="komentar[{{ $i }}]" class="w-full border rounded-md px-2 py-1 dark:bg-zinc-800 dark:border-zinc-600 dark:text-white">
                            </td>
                        </tr>

                        @if ($i === 9)
                            <tr class="font-semibold">
                                <td colspan="6" class="text-right p-2">Skill (35%)</td>
                                <td id="total-skill" class="text-center p-2">0</td>
                                <td colspan="2"></td>
                            </tr>
                        @elseif ($i === 14)
                            <tr class="font-semibold">
                                <td colspan="6" class="text-right p-2">Kinerja (35%)</td>
                                <td id="total-kinerja" class="text-center p-2">0</td>
                                <td colspan="2"></td>
                            </tr>
                        @elseif ($i === 19)
                            <tr class="font-semibold">
                                <td colspan="6" class="text-right p-2">Attitude (30%)</td>
                                <td id="total-attitude" class="text-center p-2">0</td>
                                <td colspan="2"></td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>

            <div class="flex flex-wrap gap-4 justify-start text-sm mt-6">
                <div class="w-80 flex border dark:border-white rounded overflow-hidden">
                    <div class="bg-cyan-500 text-white font-bold w-1/2 text-center py-6 text-lg">Result</div>
                    <div class="w-1/2 text-center flex items-center justify-center font-semibold text-lg bg-white dark:bg-zinc-800" id="result-persentase">0%</div>
                </div>
                <div class="w-80 flex border dark:border-white rounded overflow-hidden">
                    <div class="bg-cyan-500 text-white font-bold w-1/2 text-center py-6 text-lg">Score</div>
                    <div class="w-1/2 text-center flex items-center justify-center font-semibold text-lg bg-white dark:bg-zinc-800" id="result-score">0</div>
                </div>
                <div class="w-80 flex border dark:border-white rounded overflow-hidden">
                    <div class="bg-cyan-500 text-white font-bold w-1/2 text-center py-6 text-lg">Indeks</div>
                    <div class="w-1/2 text-center flex items-center justify-center text-2xl font-bold text-blue-700 bg-white dark:bg-zinc-800" id="result-indeks">-</div>
                </div>
            </div>

            <!-- Hidden input untuk disimpan ke database -->
            <input type="hidden" name="total_score" id="input-score">
            <input type="hidden" name="total_persentase" id="input-persentase">
            <input type="hidden" name="indeks" id="input-indeks">
        </div>

        <div class="flex justify-end gap-4 mt-4 no-print">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded text-xs font-semibold hover:bg-blue-700 uppercase tracking-wider">Simpan</button>
            <button type="button" onclick="printTable()" class="bg-green-600 text-white px-4 py-2 rounded text-xs font-semibold hover:bg-green-700 uppercase tracking-wider">Download / Print</button>
            <button type="button" onclick="resetAktual()" class="bg-gray-600 text-white px-4 py-2 rounded text-xs font-semibold hover:bg-gray-700 uppercase tracking-wider">Reset Nilai</button>
        </div>
    </form>
</div>

<script>
function setDefaultMetode() {
    const mapping = {
        "Penyusunan Rencana & Strategi / Management Planning": "Project assignment",
        "Analisa dan Penyelesaian Masalah / Analytical Thinking & Problem Solving": "Job assignment",
        "Orientasi pada kualitas kerja / Quality Orientation": "Job assignment",
        "Pertumbuhan pendapatan dan profitabilitas": "Job assignment",
        "Pencapaian Target Revenue": "Job assignment",
        "Inovasi kepemimpinan": "Job assignment",
        "Pemeliharaan dan keamanan properti": "Job assignment",
        "Kepuasan karyawan dan tamu": "Job assignment",
        "Kehadiran / Attendance": "Recording",
        "Kedisiplinan / Discipline": "Recording"
    };

    document.querySelectorAll('table tbody tr').forEach(row => {
        const kompetensiCell = row.children[2];
        const metodeSelect = row.querySelector('select[name^="metode"]');

        if (!kompetensiCell || !metodeSelect) return;

        const kompetensiText = kompetensiCell.textContent.trim();
        const metode = mapping[kompetensiText];

        if (metode) {
            metodeSelect.value = metode;
        }
    });
}

function updateHasilBobot() {
    let totalSkill = 0, totalKinerja = 0, totalAttitude = 0;

    document.querySelectorAll('.radio-group').forEach(group => {
        const idx = parseInt(group.dataset.index);
        const bobot = parseInt(group.dataset.bobot) || 0;
        const selectedRadio = group.querySelector('input[type="radio"]:checked');
        const val = selectedRadio ? parseInt(selectedRadio.value) : 0;
        const gap = 4 - val;
        const hasil = val * bobot;

        const row = group.closest('tr');
        const hasilInput = row.querySelector('.hasil-input');
        const gapInput = row.querySelector('.gap-input');

        hasilInput.value = hasil;
        gapInput.value = gap;
        highlightChange(hasilInput);
        highlightChange(gapInput);

        if (idx <= 9) totalSkill += hasil;
        else if (idx <= 14) totalKinerja += hasil;
        else totalAttitude += hasil;
    });

    document.getElementById('total-skill').textContent = totalSkill;
    document.getElementById('total-kinerja').textContent = totalKinerja;
    document.getElementById('total-attitude').textContent = totalAttitude;

    const total = totalSkill + totalKinerja + totalAttitude;
    const max = 280; // 20 kompetensi × 4 (nilai maks) × 3.5 (rata-rata bobot)
    const persen = Math.round((total / max) * 100);

    document.getElementById('result-score').textContent = total;
    document.getElementById('result-persentase').textContent = persen + '%';

    let indeks = '-';
    if (total >= 211) indeks = 'S';
    else if (total >= 141) indeks = 'A';
    else if (total >= 71) indeks = 'B';
    else if (total >= 10) indeks = 'C';

    document.getElementById('result-indeks').textContent = indeks;

    // Update hidden inputs
    document.getElementById('input-score').value = total;
    document.getElementById('input-persentase').value = persen;
    document.getElementById('input-indeks').value = indeks;
}

function highlightChange(input) {
    input.classList.add('bg-yellow-100', 'dark:bg-yellow-900');
    setTimeout(() => input.classList.remove('bg-yellow-100', 'dark:bg-yellow-900'), 500);
}

function printTable() {
    window.print();
}

function resetAktual() {
    document.querySelectorAll('.aktual-radio[value="0"]').forEach(radio => radio.checked = true);
    updateHasilBobot();
}

document.querySelectorAll('.aktual-radio').forEach(radio => {
    radio.addEventListener('change', function () {
        const val = parseInt(this.value);
        if (val < 0 || val > 4) {
            alert("Nilai aktual hanya boleh antara 0–4");
            this.checked = false;
        } else {
            updateHasilBobot();
        }
    });
});

window.addEventListener('load', () => {
    updateHasilBobot();
    setDefaultMetode();
});
</script>
</x-layouts.app>
