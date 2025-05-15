<x-layouts.app title="Tambah Laporan Harian">
    <div class="p-6 max-w-3xl mx-auto">
        <h1 class="text-2xl font-semibold mb-6">Tambah Laporan Harian</h1>

        <form action="{{ route('laporanharian.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4" novalidate>
            @csrf

            <div>
                <label for="email" class="block mb-1 font-medium">Email</label>
                <input 
                    type="email" id="email" name="email" value="{{ old('email') }}" 
                    class="w-full border rounded px-3 py-2 @error('email') border-red-600 @enderror" 
                    required
                    aria-describedby="email-error"
                >
                @error('email') 
                    <p id="email-error" class="text-red-600 text-sm mt-1">{{ $message }}</p> 
                @enderror
            </div>

            <div>
                <label for="tanggal" class="block mb-1 font-medium">Tanggal</label>
                <input 
                    type="date" id="tanggal" name="tanggal" value="{{ old('tanggal') }}" 
                    class="w-full border rounded px-3 py-2 @error('tanggal') border-red-600 @enderror" 
                    required
                    aria-describedby="tanggal-error"
                >
                @error('tanggal') 
                    <p id="tanggal-error" class="text-red-600 text-sm mt-1">{{ $message }}</p> 
                @enderror
            </div>

            <div>
                <label for="nama" class="block mb-1 font-medium">Nama</label>
                <input 
                    type="text" id="nama" name="nama" value="{{ old('nama') }}" 
                    class="w-full border rounded px-3 py-2 @error('nama') border-red-600 @enderror" 
                    required
                    aria-describedby="nama-error"
                >
                @error('nama') 
                    <p id="nama-error" class="text-red-600 text-sm mt-1">{{ $message }}</p> 
                @enderror
            </div>

            <div>
    <label for="departemen" class="block mb-1 font-medium">Departemen</label>
    <select 
        id="departemen" name="departemen" 
        class="w-full border rounded px-3 py-2 @error('departemen') border-red-600 @enderror" 
        required
        aria-describedby="departemen-error"
    >
        <option value="">-- Pilih Departemen --</option>
        <option value="Sales & Marketing" {{ old('departemen') == 'Sales & Marketing' ? 'selected' : '' }}>Sales & Marketing</option>
        <option value="Operations" {{ old('departemen') == 'Operations' ? 'selected' : '' }}>Operations</option>
        <option value="Technology" {{ old('departemen') == 'Technology' ? 'selected' : '' }}>Technology</option>
        <option value="Analytics" {{ old('departemen') == 'Analytics' ? 'selected' : '' }}>Analytics</option>
        <option value="R&D" {{ old('departemen') == 'R&D' ? 'selected' : '' }}>R&D</option>
        <option value="Procurement" {{ old('departemen') == 'Procurement' ? 'selected' : '' }}>Procurement</option>
        <option value="Finance" {{ old('departemen') == 'Finance' ? 'selected' : '' }}>Finance</option>
        <option value="HR" {{ old('departemen') == 'HR' ? 'selected' : '' }}>HR</option>
        <option value="Legal" {{ old('departemen') == 'Legal' ? 'selected' : '' }}>Legal</option>
    </select>
    @error('departemen') 
        <p id="departemen-error" class="text-red-600 text-sm mt-1">{{ $message }}</p> 
    @enderror
</div>

            <div>
                <label for="shift" class="block mb-1 font-medium">Shift</label>
                <select 
                    id="shift" name="shift" 
                    class="w-full border rounded px-3 py-2 @error('shift') border-red-600 @enderror" 
                    required
                    aria-describedby="shift-error"
                >
                    <option value="">-- Pilih Shift --</option>
                    <option value="Pagi" {{ old('shift') == 'Pagi' ? 'selected' : '' }}>Pagi</option>
                    <option value="Siang" {{ old('shift') == 'Siang' ? 'selected' : '' }}>Siang</option>
                    <option value="Malam" {{ old('shift') == 'Malam' ? 'selected' : '' }}>Malam</option>
                </select>
                @error('shift') 
                    <p id="shift-error" class="text-red-600 text-sm mt-1">{{ $message }}</p> 
                @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="jam_masuk" class="block mb-1 font-medium">Jam Masuk</label>
                    <input 
                        type="time" id="jam_masuk" name="jam_masuk" value="{{ old('jam_masuk') }}" 
                        class="w-full border rounded px-3 py-2 @error('jam_masuk') border-red-600 @enderror" 
                        required
                        aria-describedby="jam_masuk-error"
                    >
                    @error('jam_masuk') 
                        <p id="jam_masuk-error" class="text-red-600 text-sm mt-1">{{ $message }}</p> 
                    @enderror
                </div>
                <div>
                    <label for="jam_keluar" class="block mb-1 font-medium">Jam Keluar</label>
                    <input 
                        type="time" id="jam_keluar" name="jam_keluar" value="{{ old('jam_keluar') }}" 
                        class="w-full border rounded px-3 py-2 @error('jam_keluar') border-red-600 @enderror" 
                        required
                        aria-describedby="jam_keluar-error"
                    >
                    @error('jam_keluar') 
                        <p id="jam_keluar-error" class="text-red-600 text-sm mt-1">{{ $message }}</p> 
                    @enderror
                </div>
            </div>

            <div>
                <label for="pelayanan" class="block mb-1 font-medium">Pelayanan (pisahkan dengan koma)</label>
                <input 
                    type="text" id="pelayanan" name="pelayanan" value="{{ old('pelayanan') }}" 
                    placeholder="Contoh: Pelayanan A, Pelayanan B" 
                    class="w-full border rounded px-3 py-2 @error('pelayanan') border-red-600 @enderror"
                    aria-describedby="pelayanan-error"
                >
                @error('pelayanan') 
                    <p id="pelayanan-error" class="text-red-600 text-sm mt-1">{{ $message }}</p> 
                @enderror
            </div>

            <div>
                <label for="dokumentasi" class="block mb-1 font-medium">Dokumentasi (upload beberapa file)</label>
                <input 
                    type="file" id="dokumentasi" name="dokumentasi[]" multiple
                    class="w-full border rounded px-3 py-2 @error('dokumentasi') border-red-600 @enderror"
                    aria-describedby="dokumentasi-error"
                >
                @error('dokumentasi') 
                    <p id="dokumentasi-error" class="text-red-600 text-sm mt-1">{{ $message }}</p> 
                @enderror
            </div>

            <div class="flex justify-end space-x-2">
                <a href="{{ route('laporanharian.index') }}" 
                   class="px-4 py-2 border rounded hover:bg-gray-100">Batal</a>
                <button 
                    type="submit" 
                    class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700"
                >Simpan</button>
            </div>
        </form>
    </div>
</x-layouts.app>
