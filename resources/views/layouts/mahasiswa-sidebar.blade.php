<!-- resources/views/layouts/mahasiswa-sidebar.blade.php -->
<div class="bg-white border-r border-gray-200 h-16 fixed bottom-0 md:sticky md:top-0 md:h-screen z-30 w-full md:w-64 border-t md:border-t-0 overflow-y-auto font-sans">
    <div class="md:h-[73px] md:w-full md:flex md:items-center md:justify-center hidden border-b border-gray-200">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-indigo-600 to-blue-600 flex items-center justify-center shadow-md shadow-indigo-100">
                <span class="text-white font-black text-sm">AI</span>
            </div>
            <span class="font-black text-xl tracking-tighter text-gray-900">Score<span class="text-indigo-600">PNJ</span></span>
        </div>
    </div>
    <ul class="flex flex-row md:flex-col py-0 md:py-4 text-center md:text-left justify-around md:justify-start w-full h-full md:h-auto">
        <li class="flex-1 md:w-full md:mb-2 px-2 md:px-4">
            <a href="{{ route('mahasiswa.dashboard') }}" class="flex items-center gap-3 py-3 px-4 rounded-xl transition-all {{ request()->routeIs('mahasiswa.dashboard') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-100 font-bold' : 'text-gray-500 hover:bg-gray-50 hover:text-indigo-600' }}">
                <i class="fas fa-home w-5 text-center"></i>
                <span class="hidden md:block text-sm">Dashboard</span>
            </a>
        </li>
        <li class="flex-1 md:w-full md:mb-2 px-2 md:px-4">
            <a href="{{ route('mahasiswa.kelas.available') }}" class="flex items-center gap-3 py-3 px-4 rounded-xl transition-all {{ request()->routeIs('mahasiswa.kelas.available') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-100 font-bold' : 'text-gray-500 hover:bg-gray-50 hover:text-indigo-600' }}">
                <i class="fas fa-search w-5 text-center"></i>
                <span class="hidden md:block text-sm">Daftar Kelas</span>
            </a>
        </li>
        <li class="flex-1 md:w-full md:mb-2 px-2 md:px-4">
            <a href="{{ route('mahasiswa.riwayat') }}" class="flex items-center gap-3 py-3 px-4 rounded-xl transition-all {{ request()->routeIs('mahasiswa.riwayat') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-100 font-bold' : 'text-gray-500 hover:bg-gray-50 hover:text-indigo-600' }}">
                <i class="fas fa-history w-5 text-center"></i>
                <span class="hidden md:block text-sm">Riwayat Deklarasi</span>
            </a>
        </li>
    </ul>
</div>
