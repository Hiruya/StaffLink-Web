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
    'Kinerja 35%' => 4,
    'Attitude 30%' => 4,
];
@endphp

<style>
@media print {
    body * {
        visibility: hidden;
    }
    #print-area, #print-area * {
        visibility: visible;
    }
    #print-area {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        padding: 0;
        margin: 0;
    }
}
</style>

<div class="max-w-7xl mx-auto mt-6 bg-white shadow rounded-lg overflow-x-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Penilaian Kompetensi</h1>

    <form method="POST" action="{{ route('penilaian.store') }}">
        @csrf

        <!-- Area yang dicetak -->
        <div id="print-area">
            <table class="min-w-full text-sm border border-gray-300 text-gray-800 text-center mb-8">
                <thead class="bg-blue-700 text-white">
                    <tr>
                        <th>No</th>
                        <th>Kategori</th>
                        <th class="text-left">Kompetensi</th>
                        <th>Metode</th>
                        <th>Target</th>
                        <th>Aktual (1–4)</th>
                        <th>Hasil × Bobot</th>
                        <th>Gap</th>
                        <th>Komentar</th>
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
                        <tr class="{{ $i % 2 === 0 ? 'bg-gray-50' : 'bg-white' }}">
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $item['Kategori'] }}</td>
                            <td class="text-left">{{ $item['Kompetensi'] }}</td>
                            <td>
                                <select name="metode[{{ $i }}]" class="w-full border">
                                    <option value="Observation">Observation</option>
                                    <option value="Job assignment">Job assignment</option>
                                    <option value="Project assignment">Project assignment</option>
                                    <option value="Recording">Recording</option>
                                </select>
                            </td>
                            <td>
                                <input type="number" name="target[{{ $i }}]" value="4" readonly class="w-full border text-center">
                            </td>
                            <td>
                                <select name="aktual[{{ $i }}]" class="aktual w-full border text-center" data-index="{{ $i }}" data-bobot="{{ $bobot }}">
                                    @for ($j = 0; $j <= 4; $j++)
                                        <option value="{{ $j }}">{{ $j }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                <input type="text" class="hasil-input w-full border text-center" readonly value="0">
                            </td>
                            <td>
                                <input type="text" class="gap-input w-full border text-center" readonly value="0">
                            </td>
                            <td>
                                <input type="text" name="komentar[{{ $i }}]" class="w-full border">
                            </td>
                        </tr>

                        @if ($i === 9)
                            <tr class="bg-white font-bold text-right">
                                <td colspan="6">Skill (35%)</td>
                                <td id="total-skill" class="text-center text-black">0</td>
                                <td></td><td></td>
                            </tr>
                        @elseif ($i === 14)
                            <tr class="bg-white font-bold text-right">
                                <td colspan="6">Kinerja (35%)</td>
                                <td id="total-kinerja" class="text-center text-black">0</td>
                                <td></td><td></td>
                            </tr>
                        @elseif ($i === 19)
                            <tr class="bg-white font-bold text-right">
                                <td colspan="6">Attitude (30%)</td>
                                <td id="total-attitude" class="text-center text-black">0</td>
                                <td></td><td></td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>

            <!-- Hasil Akhir yang ikut dicetak -->
            <div class="flex flex-wrap gap-6 mt-10 text-sm text-center">
                <div class="border border-black flex w-80">
                    <div class="bg-cyan-500 text-white font-bold w-1/2 py-8 text-lg">Result</div>
                    <div class="flex items-center justify-center w-1/2 italic font-semibold text-xl" id="result-persentase">0%</div>
                </div>
                <div class="border border-black flex w-80">
                    <div class="bg-cyan-500 text-white font-bold w-1/2 py-8 text-lg">Score</div>
                    <div class="flex items-center justify-center w-1/2 font-semibold text-xl" id="result-score">0</div>
                </div>
                <div class="border border-black flex w-80">
                    <div class="bg-cyan-500 text-white font-bold w-1/2 py-8 text-lg">Indeks</div>
                    <div class="flex items-center justify-center w-1/2 font-bold text-blue-700 text-2xl" id="result-indeks">-</div>
                </div>
            </div>
        </div>

        <!-- Tombol -->
        <div class="mt-4 flex justify-end gap-4 no-print">
        <button type="submit" class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-800 transition">
                Simpan
            </button>
            <button type="button" onclick="printTable()" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
                Download / Print
            </button>
        </div>
    </form>
</div>

<script>
function updateHasilBobot() {
    let totalSkill = 0, totalKinerja = 0, totalAttitude = 0;
    document.querySelectorAll('.aktual').forEach(select => {
        const val = parseInt(select.value) || 0;
        const bobot = parseInt(select.dataset.bobot) || 0;
        const idx = parseInt(select.dataset.index);
        const gap = 4 - val;
        const hasil = val * bobot;

        const row = select.closest('tr');
        row.querySelector('.hasil-input').value = hasil;
        row.querySelector('.gap-input').value = gap;

        if (idx <= 9) totalSkill += hasil;
        else if (idx <= 14) totalKinerja += hasil;
        else totalAttitude += hasil;
    });

    document.getElementById('total-skill').textContent = totalSkill;
    document.getElementById('total-kinerja').textContent = totalKinerja;
    document.getElementById('total-attitude').textContent = totalAttitude;

    const total = totalSkill + totalKinerja + totalAttitude;
    const max = 20 * 4 * 4;
    const persen = ((total / max) * 100).toFixed(0);

    document.getElementById('result-score').textContent = total;
    document.getElementById('result-persentase').textContent = persen + '%';

    let indeks = '-';
    if (total >= 211) indeks = 'S';
    else if (total >= 141) indeks = 'A';
    else if (total >= 71) indeks = 'B';
    else if (total >= 10) indeks = 'C';

    document.getElementById('result-indeks').textContent = indeks;
}

function printTable() {
    window.print();
}

document.querySelectorAll('.aktual').forEach(select => {
    select.addEventListener('change', updateHasilBobot);
});
window.addEventListener('load', updateHasilBobot);
</script>
</x-layouts.app>
