<x-layouts.app>
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-zinc-800 dark:text-zinc-100">Edit Data Karyawan</h1>
            <p class="text-zinc-600 dark:text-zinc-400">Silakan perbarui data karyawan Anda.</p>
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

        <!-- Form -->
        <div class="bg-white rounded-lg shadow dark:bg-zinc-800 p-6">
            <form action="{{ route('karyawan.update', $karyawan->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Employee ID (readonly) -->
                    <div>
                        <label for="employee_id" class="block mb-2 text-sm font-medium text-zinc-900 dark:text-zinc-100">Employee ID</label>
                        <input type="number" id="employee_id" name="employee_id" value="{{ $karyawan->employee_id }}" readonly
                            class="bg-zinc-100 border border-zinc-300 text-zinc-900 text-sm rounded-lg block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white cursor-not-allowed">
                    </div>

                    <!-- Name -->
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-zinc-900 dark:text-zinc-100">Nama Lengkap</label>
                        <input type="text" id="name" name="name" value="{{ $karyawan->name }}" required
                            class="bg-zinc-50 border border-zinc-300 text-zinc-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white">
                    </div>

                    <!-- Department -->
                    <div>
                        <label for="department" class="block mb-2 text-sm font-medium text-zinc-900 dark:text-zinc-100">Department</label>
                        <input type="text" id="department" name="department" value="{{ $karyawan->department }}" required
                            class="bg-zinc-50 border border-zinc-300 text-zinc-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white">
                    </div>

                    <!-- Region -->
                    <div>
                        <label for="region" class="block mb-2 text-sm font-medium text-zinc-900 dark:text-zinc-100">Region</label>
                        <input type="text" id="region" name="region" value="{{ $karyawan->region }}" required
                            class="bg-zinc-50 border border-zinc-300 text-zinc-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white">
                    </div>

                    <!-- Education -->
                    <div>
                        <label for="education" class="block mb-2 text-sm font-medium text-zinc-900 dark:text-zinc-100">Pendidikan</label>
                        <input type="text" id="education" name="education" value="{{ $karyawan->education }}" required
                            class="bg-zinc-50 border border-zinc-300 text-zinc-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white">
                    </div>

                    <!-- Gender -->
                    <div>
                        <label for="gender" class="block mb-2 text-sm font-medium text-zinc-900 dark:text-zinc-100">Jenis Kelamin</label>
                        <select id="gender" name="gender" required
                            class="bg-zinc-50 border border-zinc-300 text-zinc-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white">
                            <option value="male" {{ $karyawan->gender == 'male' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="female" {{ $karyawan->gender == 'female' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>

                    <!-- Recruitment Channel -->
                    <div>
                        <label for="recruitment_channel" class="block mb-2 text-sm font-medium text-zinc-900 dark:text-zinc-100">Rekrutmen Channel</label>
                        <input type="text" id="recruitment_channel" name="recruitment_channel" value="{{ $karyawan->recruitment_channel }}" required
                            class="bg-zinc-50 border border-zinc-300 text-zinc-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white">
                    </div>

                    <!-- Number of Trainings -->
                    <div>
                        <label for="no_of_trainings" class="block mb-2 text-sm font-medium text-zinc-900 dark:text-zinc-100">Jumlah Pelatihan</label>
                        <input type="number" id="no_of_trainings" name="no_of_trainings" value="{{ $karyawan->no_of_trainings }}" required min="0"
                            class="bg-zinc-50 border border-zinc-300 text-zinc-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white">
                    </div>

                    <!-- Age -->
                    <div>
                        <label for="age" class="block mb-2 text-sm font-medium text-zinc-900 dark:text-zinc-100">Usia</label>
                        <input type="number" id="age" name="age" value="{{ $karyawan->age }}" required min="18" max="65"
                            class="bg-zinc-50 border border-zinc-300 text-zinc-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white">
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('karyawan.index') }}"
                       class="px-5 py-2.5 text-zinc-800 bg-zinc-100 hover:bg-zinc-200 rounded-lg dark:text-white dark:bg-zinc-700 dark:hover:bg-zinc-600 transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-5 py-2.5 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</x-layouts.app>
