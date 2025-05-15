<x-layouts.app>
    @section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @endsection
    <div class="space-y-6 p-6">
        <div class="max-w-4xl mx-auto bg-white dark:bg-zinc-800 rounded-lg shadow-md overflow-hidden">
            <div class="px-6 py-4 border-b border-zinc-200 dark:border-zinc-700">
                <h2 class="text-2xl font-semibold">Prediksi Promosi Karyawan</h2>
            </div>

            <!-- Notifikasi -->
            @if (session()->has('success'))
                <div class="px-4 py-2 bg-green-100 text-green-800 rounded dark:bg-green-900 dark:text-green-200 mx-4 mt-4">
                    {{ session('success') }}
                </div>
            @endif

            @if (session()->has('error'))
                <div class="px-4 py-2 bg-red-100 text-red-800 rounded dark:bg-red-900 dark:text-red-200 mx-4 mt-4">
                    {{ session('error') }}
                </div>
            @endif

            <form id="predictionForm" class="p-6 space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Kolom Pertama -->
                    <div class="space-y-4">
                        <div>
                            <label for="department" class="block mb-2 text-sm font-medium text-zinc-900 dark:text-white">Departemen</label>
                            <select id="department" class="bg-zinc-50 border border-zinc-300 text-zinc-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white" required>
                                <option value="">Pilih Departemen</option>
                                <option value="1">Sales & Marketing</option>
                                <option value="2">Operations</option>
                                <option value="3">Technology</option>
                                <option value="4">Analytics</option>
                                <option value="5">R&D</option>
                                <option value="6">Procurement</option>
                                <option value="7">Finance</option>
                                <option value="8">HR</option>
                                <option value="9">Legal</option>
                            </select>
                        </div>

                        <div>
                            <label for="education" class="block mb-2 text-sm font-medium text-zinc-900 dark:text-white">Pendidikan</label>
                            <select id="education" class="bg-zinc-50 border border-zinc-300 text-zinc-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white" required>
                                <option value="">Pilih Pendidikan</option>
                                <option value="1">Below Secondary</option>
                                <option value="2">Bachelor's</option>
                                <option value="3">Master's & above</option>
                            </select>
                        </div>

                        <div>
                            <label for="gender" class="block mb-2 text-sm font-medium text-zinc-900 dark:text-white">Jenis Kelamin</label>
                            <select id="gender" class="bg-zinc-50 border border-zinc-300 text-zinc-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white" required>
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="0">Perempuan</option>
                                <option value="1">Laki-laki</option>
                            </select>
                        </div>

                        <div>
                            <label for="recruitment_channel" class="block mb-2 text-sm font-medium text-zinc-900 dark:text-white">Channel Rekrutmen</label>
                            <select id="recruitment_channel" class="bg-zinc-50 border border-zinc-300 text-zinc-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white" required>
                                <option value="">Pilih Channel</option>
                                <option value="0">Lainnya</option>
                                <option value="1">Referral</option>
                                <option value="2">Sourcing</option>
                            </select>
                        </div>
                    </div>

                    <!-- Kolom Kedua -->
                    <div class="space-y-4">
                        <div>
                            <label for="no_of_trainings" class="block mb-2 text-sm font-medium text-zinc-900 dark:text-white">Jumlah Pelatihan</label>
                            <input type="number" id="no_of_trainings" min="0" class="bg-zinc-50 border border-zinc-300 text-zinc-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white" required>
                        </div>

                        <div>
                            <label for="age" class="block mb-2 text-sm font-medium text-zinc-900 dark:text-white">Usia</label>
                            <input type="number" id="age" min="18" max="60" class="bg-zinc-50 border border-zinc-300 text-zinc-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white" required>
                        </div>

                        <div>
                            <label for="previous_year_rating" class="block mb-2 text-sm font-medium text-zinc-900 dark:text-white">Rating Tahun Lalu (1-5)</label>
                            <input type="number" id="previous_year_rating" min="1" max="5" class="bg-zinc-50 border border-zinc-300 text-zinc-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white" required>
                        </div>

                        <div>
                            <label for="length_of_service" class="block mb-2 text-sm font-medium text-zinc-900 dark:text-white">Masa Kerja (tahun)</label>
                            <input type="number" id="length_of_service" min="1" max="20" class="bg-zinc-50 border border-zinc-300 text-zinc-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white" required>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="awards_won" class="block mb-2 text-sm font-medium text-zinc-900 dark:text-white">Memenangkan Penghargaan?</label>
                        <select id="awards_won" class="bg-zinc-50 border border-zinc-300 text-zinc-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white" required>
                            <option value="">Pilih</option>
                            <option value="0">Tidak</option>
                            <option value="1">Ya</option>
                        </select>
                    </div>
                    <div>
                        <label for="avg_training_score" class="block mb-2 text-sm font-medium text-zinc-900 dark:text-white">Rata-rata Skor Pelatihan</label>
                        <input type="number" step="0.1" id="avg_training_score" min="0" max="100" class="bg-zinc-50 border border-zinc-300 text-zinc-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white" required>
                    </div>
                    <div>
                        <label for="kpis_met" class="block mb-2 text-sm font-medium text-zinc-900 dark:text-white">KPIs >80%?</label>
                        <select id="kpis_met" class="bg-zinc-50 border border-zinc-300 text-zinc-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white" required>
                            <option value="">Pilih</option>
                            <option value="0">Tidak</option>
                            <option value="1">Ya</option>
                        </select>
                    </div>
                </div>

                <div class="flex justify-center pt-4">
                    <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white font-medium text-sm leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                        Prediksi Promosi
                    </button>
                </div>
            </form>

            <div id="resultContainer" class="px-6 pb-6 hidden">
                <div class="bg-white dark:bg-zinc-700 rounded-lg shadow overflow-hidden">
                    <div class="px-4 py-3 border-b border-zinc-200 dark:border-zinc-600 bg-zinc-50 dark:bg-zinc-800">
                        <h3 class="font-semibold text-lg">Hasil Prediksi</h3>
                    </div>
                    <div class="p-4">
                        <p id="predictionResult" class="text-xl font-bold"></p>
                        <div id="predictionDetails" class="mt-3 text-sm"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('predictionForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            // Ambil semua nilai form
            const formData = {
                department: document.getElementById('department').value,
                education: document.getElementById('education').value,
                gender: document.getElementById('gender').value,
                recruitment_channel: document.getElementById('recruitment_channel').value,
                no_of_trainings: document.getElementById('no_of_trainings').value,
                age: document.getElementById('age').value,
                previous_year_rating: document.getElementById('previous_year_rating').value,
                length_of_service: document.getElementById('length_of_service').value,
                awards_won: document.getElementById('awards_won').value,
                avg_training_score: document.getElementById('avg_training_score').value,
                kpis_met: document.getElementById('kpis_met').value
            };

            // Validasi form
            for (const key in formData) {
                if (formData[key] === '') {
                    alert('Harap lengkapi semua field!');
                    return;
                }
            }

            // Tampilkan loading
            const submitBtn = e.target.querySelector('button[type="submit"]');
            const originalBtnHTML = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = `
                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Memproses...
            `;

            try {
                // Ambil CSRF token dengan berbagai fallback
                const csrfToken = document.querySelector('input[name="_token"]')?.value ||
                                document.querySelector('meta[name="csrf-token"]')?.content;

                if (!csrfToken) {
                    throw new Error('CSRF token not found');
                }

                // Kirim request ke endpoint Laravel
                const response = await fetch('api/predict-promotion', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify(formData)
                });

                if (response.status === 419) { // Token mismatch
                    throw new Error('Session expired. Please refresh the page and try again.');
                }

                const data = await response.json();

                // Tampilkan hasil
                const resultContainer = document.getElementById('resultContainer');
                const predictionResult = document.getElementById('predictionResult');
                const predictionDetails = document.getElementById('predictionDetails');

                if (data.status === 'success') {
                    const isPromoted = data.prediction === 'promoted' || data.prediction === '1';

                    predictionResult.textContent = isPromoted
                        ? 'Hasil: DI PROMOSI'
                        : 'Hasil: TIDAK DI PROMOSI';

                    predictionResult.className = isPromoted
                        ? 'text-xl font-bold text-green-600 dark:text-green-400'
                        : 'text-xl font-bold text-red-600 dark:text-red-400';

                    // Tampilkan detail (opsional)
                    predictionDetails.innerHTML = `
                        <p class="font-medium mb-2">Detail Input:</p>
                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <p class="text-zinc-600 dark:text-zinc-300">Departemen:</p>
                                <p class="font-medium">${getDepartmentName(formData.department)}</p>
                            </div>
                            <div>
                                <p class="text-zinc-600 dark:text-zinc-300">Pendidikan:</p>
                                <p class="font-medium">${getEducationName(formData.education)}</p>
                            </div>
                            <div>
                                <p class="text-zinc-600 dark:text-zinc-300">Rating Tahun Lalu:</p>
                                <p class="font-medium">${formData.previous_year_rating}</p>
                            </div>
                            <div>
                                <p class="text-zinc-600 dark:text-zinc-300">Skor Pelatihan:</p>
                                <p class="font-medium">${formData.avg_training_score}</p>
                            </div>
                            <div>
                                <p class="text-zinc-600 dark:text-zinc-300">KPIs >80%:</p>
                                <p class="font-medium">${formData.kpis_met === '1' ? 'Ya' : 'Tidak'}</p>
                            </div>
                            <div>
                                <p class="text-zinc-600 dark:text-zinc-300">Penghargaan:</p>
                                <p class="font-medium">${formData.awards_won === '1' ? 'Ya' : 'Tidak'}</p>
                            </div>
                        </div>
                    `;

                    resultContainer.classList.remove('hidden');
                    resultContainer.scrollIntoView({ behavior: 'smooth' });
                } else {
                    predictionResult.textContent = 'Error: ' + (data.message || 'Terjadi kesalahan');
                    predictionResult.className = 'text-xl font-bold text-red-600 dark:text-red-400';
                    predictionDetails.innerHTML = '';
                    resultContainer.classList.remove('hidden');
                }
            } catch (error) {
                console.error('Error:', error);
                const resultContainer = document.getElementById('resultContainer');
                const predictionResult = document.getElementById('predictionResult');

                predictionResult.textContent = error.message || 'Terjadi kesalahan saat menghubungi server';
                predictionResult.className = 'text-xl font-bold text-red-600 dark:text-red-400';
                document.getElementById('predictionDetails').innerHTML = '';
                resultContainer.classList.remove('hidden');
            } finally {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalBtnHTML;
            }
        });

        function getDepartmentName(value) {
            const departments = {
                '1': 'Sales & Marketing',
                '2': 'Operations',
                '3': 'Technology',
                '4': 'Analytics',
                '5': 'R&D',
                '6': 'Procurement',
                '7': 'Finance',
                '8': 'HR',
                '9': 'Legal'
            };
            return departments[value] || 'Unknown';
        }

        function getEducationName(value) {
            const educations = {
                '1': 'Below Secondary',
                '2': "Bachelor's",
                '3': "Master's & above"
            };
            return educations[value] || 'Unknown';
        }
    </script>
</x-layouts.app>
