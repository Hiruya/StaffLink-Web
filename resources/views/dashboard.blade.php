<x-layouts.app title="Dashboard">
    <div 
        x-data="{ modalType: '', selectedId: null }" 
        class="relative h-full flex-1 overflow-x-auto rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 p-4"
        
        <!-- Custom Cards Section -->

        <div class="mt-6 bg-blue-200 p-6 rounded-lg flex flex-wrap gap-6">
    <div class="bg-blue-500 hover:bg-blue-600 p-6 rounded-lg shadow flex-1 h-60">
        <h3 class="text-white font-semibold">Kehadiran Karyawan Hari Ini</h3>
        <p class="text-white">{{ $jumlahHariIni }}</p>
        <a href="/absensi" class="mt-4 inline-block bg-white text-blue-500 font-semibold px-4 py-2 rounded hover:bg-gray-100 transition">
            view
        </a>
    </div>

    <div class="bg-blue-500 hover:bg-blue-600 p-6 rounded-lg shadow flex-1 h-60">
        <h3 class="text-white font-semibold">Active Task</h3>
        <p class="text-white">132</p>
        <a href="/jadwal" class="mt-4 inline-block bg-white text-blue-500 font-semibold px-4 py-2 rounded hover:bg-gray-100 transition">
            view
        </a>
    </div>
    
    <div class="bg-blue-500 hover:bg-blue-600 p-6 rounded-lg shadow flex-1 h-60">
        <h3 class="text-white font-semibold">Teams</h3>
        <p class="text-white">12</p>
        <a href="/absensi" class="mt-4 inline-block bg-white text-blue-500 font-semibold px-4 py-2 rounded hover:bg-gray-100 transition">
            view
        </a>
    </div>
</div>




            <div class="mt-6">
                <button class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Create New Project</button>
            </div>
        </div>
    </div>
</x-layouts.app>
