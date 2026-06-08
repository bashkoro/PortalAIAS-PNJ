<!-- resources/views/layouts/mahasiswa-sidebar.blade.php -->
<div class="bg-gradient-to-b from-[#0d2b1a] to-[#1a3d28] border-r border-emerald-900/50 h-16 fixed bottom-0 md:sticky md:top-0 md:h-screen z-30 w-full md:w-64 border-t border-emerald-800 md:border-t-0 overflow-y-auto shadow-xl">
    <div class="md:h-[73px] md:w-full md:flex md:items-center md:justify-center hidden border-b border-emerald-800/50">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-emerald-500 flex items-center justify-center shadow-md shadow-emerald-900/50">
                <span class="text-white font-bold text-sm">AI</span>
            </div>
            <span class="font-bold text-xl tracking-tight text-white">Score<span class="text-emerald-400">PNJ</span></span>
        </div>
    </div>
    <ul class="flex flex-row md:flex-col py-0 md:py-4 text-center md:text-left justify-around md:justify-start w-full h-full md:h-auto">
        <li class="flex-1 md:w-full md:mb-2">
            <a href="{{ route('mahasiswa.dashboard') }}" class="block py-3 md:py-3 pl-1 align-middle {{ request()->routeIs('mahasiswa.dashboard') ? 'text-white border-b-4 border-emerald-400 md:border-b-0 md:border-l-4 bg-emerald-800/50 font-semibold' : 'text-emerald-100/70 hover:text-white hover:bg-emerald-800/30' }} no-underline transition-colors">
                <i class="fas fa-home pr-0 md:pr-3 ml-4 {{ request()->routeIs('mahasiswa.dashboard') ? 'text-emerald-400' : '' }}"></i><span class="pb-1 md:pb-0 text-sm md:text-base block md:inline-block">Dashboard</span>
            </a>
        </li>
        <li class="flex-1 md:w-full md:mb-2">
            <a href="{{ route('mahasiswa.kelas.available') }}" class="block py-3 md:py-3 pl-1 align-middle {{ request()->routeIs('mahasiswa.kelas.available') ? 'text-white border-b-4 border-emerald-400 md:border-b-0 md:border-l-4 bg-emerald-800/50 font-semibold' : 'text-emerald-100/70 hover:text-white hover:bg-emerald-800/30' }} no-underline transition-colors">
                <i class="fas fa-search pr-0 md:pr-3 ml-4 {{ request()->routeIs('mahasiswa.kelas.available') ? 'text-emerald-400' : '' }}"></i><span class="pb-1 md:pb-0 text-sm md:text-base block md:inline-block">Daftar Kelas</span>
            </a>
        </li>
        <li class="flex-1 md:w-full md:mb-2">
            <a href="{{ route('mahasiswa.riwayat') }}" class="block py-3 md:py-3 pl-1 align-middle {{ request()->routeIs('mahasiswa.riwayat') ? 'text-white border-b-4 border-emerald-400 md:border-b-0 md:border-l-4 bg-emerald-800/50 font-semibold' : 'text-emerald-100/70 hover:text-white hover:bg-emerald-800/30' }} no-underline transition-colors">
                <i class="fas fa-history pr-0 md:pr-3 ml-4 {{ request()->routeIs('mahasiswa.riwayat') ? 'text-emerald-400' : '' }}"></i><span class="pb-1 md:pb-0 text-sm md:text-base block md:inline-block">Riwayat Deklarasi</span>
            </a>
        </li>
    </ul>
</div>
