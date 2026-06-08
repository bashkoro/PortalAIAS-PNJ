<!-- resources/views/layouts/dosen-sidebar.blade.php -->
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
            <a href="{{ route('dosen.dashboard') }}" class="block py-3 md:py-3 pl-1 align-middle {{ request()->routeIs('dosen.dashboard') ? 'text-white border-b-4 border-emerald-400 md:border-b-0 md:border-l-4 bg-emerald-800/50 font-semibold' : 'text-emerald-100/70 hover:text-white hover:bg-emerald-800/30' }} no-underline transition-colors">
                <i class="fas fa-chart-pie pr-0 md:pr-3 ml-4 {{ request()->routeIs('dosen.dashboard') ? 'text-emerald-400' : '' }}"></i><span class="pb-1 md:pb-0 text-sm md:text-base block md:inline-block">Dashboard</span>
            </a>
        </li>
        <li class="flex-1 md:w-full md:mb-2">
            <a href="{{ route('dosen.kelas.available') }}" class="block py-3 md:py-3 pl-1 align-middle {{ request()->routeIs('dosen.kelas.available') ? 'text-white border-b-4 border-emerald-400 md:border-b-0 md:border-l-4 bg-emerald-800/50 font-semibold' : 'text-emerald-100/70 hover:text-white hover:bg-emerald-800/30' }} no-underline transition-colors">
                <i class="fas fa-plus-circle pr-0 md:pr-3 ml-4 {{ request()->routeIs('dosen.kelas.available') ? 'text-emerald-400' : '' }}"></i><span class="pb-1 md:pb-0 text-sm md:text-base block md:inline-block">Ambil Kelas</span>
            </a>
        </li>
        <li class="flex-1 md:w-full md:mb-2">
            <a href="{{ route('dosen.tugas.create') }}" class="block py-3 md:py-3 pl-1 align-middle {{ request()->routeIs('dosen.tugas.create') ? 'text-white border-b-4 border-emerald-400 md:border-b-0 md:border-l-4 bg-emerald-800/50 font-semibold' : 'text-emerald-100/70 hover:text-white hover:bg-emerald-800/30' }} no-underline transition-colors">
                <i class="fas fa-file-alt pr-0 md:pr-3 ml-4 {{ request()->routeIs('dosen.tugas.create') ? 'text-emerald-400' : '' }}"></i><span class="pb-1 md:pb-0 text-sm md:text-base block md:inline-block">Buat Tugas</span>
            </a>
        </li>
        <li class="flex-1 md:w-full md:mb-2">
            <a href="{{ route('dosen.riwayat') }}" class="block py-3 md:py-3 pl-1 align-middle {{ request()->routeIs('dosen.riwayat') ? 'text-white border-b-4 border-emerald-400 md:border-b-0 md:border-l-4 bg-emerald-800/50 font-semibold' : 'text-emerald-100/70 hover:text-white hover:bg-emerald-800/30' }} no-underline transition-colors">
                <i class="fas fa-history pr-0 md:pr-3 ml-4 {{ request()->routeIs('dosen.riwayat') ? 'text-emerald-400' : '' }}"></i><span class="pb-1 md:pb-0 text-sm md:text-base block md:inline-block">Riwayat Tugas</span>
            </a>
        </li>
    </ul>
</div>
