<x-layouts.app title="Dashboard">
    <div 
        x-data="{ modalType: '', selectedId: null }" 
        class="relative h-full flex-1 overflow-x-auto rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 p-4">

        <!-- Custom Cards Section -->
        <div class="mt-6 bg-blue-200 p-6 rounded-lg flex flex-wrap gap-6">
            <div class="bg-blue-500 hover:bg-blue-600 p-6 rounded-lg shadow flex-1 h-60">
                <h3 class="text-white font-semibold">Kehadiran Karyawan Hari Ini</h3>
                <p class="text-white text-3xl">{{ $jumlahHariIni }}</p>
                <a href="/absensi" class="mt-4 inline-block bg-white text-blue-500 font-semibold px-4 py-2 rounded hover:bg-gray-100 transition">
                    view
                </a>
            </div>

            <div class="bg-blue-500 hover:bg-blue-600 p-6 rounded-lg shadow flex-1 h-60">
                <h3 class="text-white font-semibold">Rekap Penilaian</h3>
                <p class="text-white text-3xl">0</p>
                <a href="/penilaian/tampil" class="mt-4 inline-block bg-white text-blue-500 font-semibold px-4 py-2 rounded hover:bg-gray-100 transition">
                    view
                </a>
            </div>
        </div>

        <!-- Grafik Promosi -->
        <div class="mt-10 bg-white dark:bg-neutral-800 p-6 rounded-lg shadow">
            <h3 class="text-xl font-semibold text-neutral-800 dark:text-white mb-4">Status Promosi</h3>
            <canvas id="promotionChart" height="100"></canvas>
        </div>
    </div>

    <!-- Chart.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            fetch('/grafik-promosi')
                .then(response => response.json())
                .then(data => {
                    const ctx = document.getElementById('promotionChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ['Promoted', 'Not Promoted'],
                            datasets: [{
                                label: 'Jumlah Karyawan',
                                data: [data.promosi, data.tidak_promosi],
                                backgroundColor: ['#4ade80', '#f87171'],
                                borderRadius: 5
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: { display: false },
                                tooltip: {
                                    callbacks: {
                                        label: context => `${context.dataset.label}: ${context.raw}`
                                    }
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                });
        });
    </script>
</x-layouts.app>
