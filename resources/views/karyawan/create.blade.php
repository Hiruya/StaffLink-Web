{{-- <x-layouts.app>
<div class="container">
    <h1>Isi Data Karyawan</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-warning">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('karyawan.store') }}" method="POST">
        @csrf

        <label>Employee ID:</label>
        <input type="number" name="employee_id" required><br>

        <label>Nama:</label>
        <input type="text" name="name" required><br>

        <label>Department:</label>
        <input type="text" name="department" required><br>

        <label>Region:</label>
        <input type="text" name="region" required><br>

        <label>Pendidikan:</label>
        <input type="text" name="education" required><br>

        <label>Gender:</label>
        <select name="gender" required>
            <option value="">-- Pilih --</option>
            <option value="male">Laki-laki</option>
            <option value="female">Perempuan</option>
        </select><br>

        <label>Rekrutmen Channel:</label>
        <input type="text" name="recruitment_channel" required><br>

        <label>Jumlah Pelatihan:</label>
        <input type="number" name="no_of_trainings" required><br>

        <label>Usia:</label>
        <input type="number" name="age" required><br>

        <button type="submit">Simpan</button>
    </form>
</div>
</x-layouts.app> --}}

<x-layouts.app>
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-zinc-800 dark:text-zinc-100">Isi Data Karyawan</h1>
            <p class="text-zinc-600 dark:text-zinc-400">Silakan lengkapi form berikut untuk mengisi data karyawan Anda.</p>
        </div>

        <!-- Notifications -->
        @if ($errors->any())
            <div class="mb-6 px-4 py-3 bg-red-100 text-red-700 rounded-lg dark:bg-red-900 dark:text-red-100">
                <h3 class="font-medium">Terjadi kesalahan:</h3>
                <ul class="mt-1 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('error'))
            <div class="mb-6 px-4 py-3 bg-yellow-100 text-yellow-700 rounded-lg dark:bg-yellow-900 dark:text-yellow-100">
                {{ session('error') }}
            </div>
        @endif

        <!-- Form -->
        <div class="bg-white rounded-lg shadow dark:bg-zinc-800 p-6">
            <form action="{{ route('karyawan.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Employee ID -->
                    <div>
                        <label for="employee_id" class="block mb-2 text-sm font-medium text-zinc-900 dark:text-zinc-100">Employee ID</label>
                        <input type="number" id="employee_id" name="employee_id" required
                            class="bg-zinc-50 border border-zinc-300 text-zinc-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white">
                    </div>

                    <!-- Name -->
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-zinc-900 dark:text-zinc-100">Nama Lengkap</label>
                        <input type="text" id="name" name="name" required
                            class="bg-zinc-50 border border-zinc-300 text-zinc-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white">
                    </div>

                    <!-- Department -->
                    <div>
                        <label for="department" class="block mb-2 text-sm font-medium text-zinc-900 dark:text-zinc-100">Department</label>
                        <input type="text" id="department" name="department" required
                            class="bg-zinc-50 border border-zinc-300 text-zinc-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white">
                    </div>

                    <!-- Region -->
                    <div>
                        <label for="region" class="block mb-2 text-sm font-medium text-zinc-900 dark:text-zinc-100">Region</label>
                        <input type="text" id="region" name="region" required
                            class="bg-zinc-50 border border-zinc-300 text-zinc-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white">
                    </div>

                    <!-- Education -->
                    <div>
                        <label for="education" class="block mb-2 text-sm font-medium text-zinc-900 dark:text-zinc-100">Pendidikan</label>
                        <input type="text" id="education" name="education" required
                            class="bg-zinc-50 border border-zinc-300 text-zinc-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white">
                    </div>

                    <!-- Gender -->
                    <div>
                        <label for="gender" class="block mb-2 text-sm font-medium text-zinc-900 dark:text-zinc-100">Jenis Kelamin</label>
                        <select id="gender" name="gender" required
                            class="bg-zinc-50 border border-zinc-300 text-zinc-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white">
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="male">Laki-laki</option>
                            <option value="female">Perempuan</option>
                        </select>
                    </div>

                    <!-- Recruitment Channel -->
                    <div>
                        <label for="recruitment_channel" class="block mb-2 text-sm font-medium text-zinc-900 dark:text-zinc-100">Rekrutmen Channel</label>
                        <input type="text" id="recruitment_channel" name="recruitment_channel" required
                            class="bg-zinc-50 border border-zinc-300 text-zinc-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white">
                    </div>

                    <!-- Number of Trainings -->
                    <div>
                        <label for="no_of_trainings" class="block mb-2 text-sm font-medium text-zinc-900 dark:text-zinc-100">Jumlah Pelatihan</label>
                        <input type="number" id="no_of_trainings" name="no_of_trainings" required min="0"
                            class="bg-zinc-50 border border-zinc-300 text-zinc-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white">
                    </div>

                    <!-- Age -->
                    <div>
                        <label for="age" class="block mb-2 text-sm font-medium text-zinc-900 dark:text-zinc-100">Usia</label>
                        <input type="number" id="age" name="age" required min="18" max="65"
                            class="bg-zinc-50 border border-zinc-300 text-zinc-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white">
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</x-layouts.app>
