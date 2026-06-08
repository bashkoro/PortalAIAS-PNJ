<!-- resources/views/layouts/sidebar.blade.php -->
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
            <a href="{{ route('admin.dashboard') }}" class="block py-3 md:py-3 pl-1 align-middle {{ request()->routeIs('admin.dashboard') ? 'text-white border-b-4 border-emerald-400 md:border-b-0 md:border-l-4 bg-emerald-800/50 font-semibold' : 'text-emerald-100/70 hover:text-white hover:bg-emerald-800/30' }} no-underline transition-colors">
                <i class="fas fa-chart-pie pr-0 md:pr-3 ml-4 {{ request()->routeIs('admin.dashboard') ? 'text-emerald-400' : '' }}"></i><span class="pb-1 md:pb-0 text-sm md:text-base block md:inline-block">Dashboard</span>
            </a>
        </li>
        <li class="flex-1 md:w-full md:mb-2">
            <a href="{{ route('admin.users.index') }}" class="block py-3 md:py-3 pl-1 align-middle {{ request()->routeIs('admin.users.*') ? 'text-white border-b-4 border-emerald-400 md:border-b-0 md:border-l-4 bg-emerald-800/50 font-semibold' : 'text-emerald-100/70 hover:text-white hover:bg-emerald-800/30' }} no-underline transition-colors">
                <i class="fas fa-users pr-0 md:pr-3 ml-4 {{ request()->routeIs('admin.users.*') ? 'text-emerald-400' : '' }}"></i><span class="pb-1 md:pb-0 text-sm md:text-base block md:inline-block">Pengguna</span>
            </a>
        </li>
        <li class="flex-1 md:w-full md:mb-2">
            <a href="{{ route('admin.rules.index') }}" class="block py-3 md:py-3 pl-1 align-middle {{ request()->routeIs('admin.rules.*') || request()->routeIs('admin.aturan.*') ? 'text-white border-b-4 border-emerald-400 md:border-b-0 md:border-l-4 bg-emerald-800/50 font-semibold' : 'text-emerald-100/70 hover:text-white hover:bg-emerald-800/30' }} no-underline transition-colors">
                <i class="fas fa-cogs pr-0 md:pr-3 ml-4 {{ request()->routeIs('admin.rules.*') || request()->routeIs('admin.aturan.*') ? 'text-emerald-400' : '' }}"></i><span class="pb-1 md:pb-0 text-sm md:text-base block md:inline-block">Aturan AIAS</span>
            </a>
        </li>
        <li class="flex-1 md:w-full md:mb-2">
            <a href="{{ route('admin.program-studi.index') }}" class="block py-3 md:py-3 pl-1 align-middle {{ request()->routeIs('admin.program-studi.*') ? 'text-white border-b-4 border-emerald-400 md:border-b-0 md:border-l-4 bg-emerald-800/50 font-semibold' : 'text-emerald-100/70 hover:text-white hover:bg-emerald-800/30' }} no-underline transition-colors">
                <i class="fas fa-graduation-cap pr-0 md:pr-3 ml-4 {{ request()->routeIs('admin.program-studi.*') ? 'text-emerald-400' : '' }}"></i><span class="pb-1 md:pb-0 text-sm md:text-base block md:inline-block">Program Studi</span>
            </a>
        </li>
        <li class="flex-1 md:w-full md:mb-2">
            <a href="{{ route('admin.periode-akademik.index') }}" class="block py-3 md:py-3 pl-1 align-middle {{ request()->routeIs('admin.periode-akademik.*') ? 'text-white border-b-4 border-emerald-400 md:border-b-0 md:border-l-4 bg-emerald-800/50 font-semibold' : 'text-emerald-100/70 hover:text-white hover:bg-emerald-800/30' }} no-underline transition-colors">
                <i class="fas fa-calendar-alt pr-0 md:pr-3 ml-4 {{ request()->routeIs('admin.periode-akademik.*') ? 'text-emerald-400' : '' }}"></i><span class="pb-1 md:pb-0 text-sm md:text-base block md:inline-block">Periode Akademik</span>
            </a>
        </li>
        <li class="flex-1 md:w-full md:mb-2">
            <a href="{{ route('admin.mata-kuliah.index') }}" class="block py-3 md:py-3 pl-1 align-middle {{ request()->routeIs('admin.mata-kuliah.*') ? 'text-white border-b-4 border-emerald-400 md:border-b-0 md:border-l-4 bg-emerald-800/50 font-semibold' : 'text-emerald-100/70 hover:text-white hover:bg-emerald-800/30' }} no-underline transition-colors">
                <i class="fas fa-book-open pr-0 md:pr-3 ml-4 {{ request()->routeIs('admin.mata-kuliah.*') ? 'text-emerald-400' : '' }}"></i><span class="pb-1 md:pb-0 text-sm md:text-base block md:inline-block">Mata Kuliah</span>
            </a>
        </li>
        <li class="flex-1 md:w-full md:mb-2">
            <a href="{{ route('admin.kelas-kuliah.index') }}" class="block py-3 md:py-3 pl-1 align-middle {{ request()->routeIs('admin.kelas-kuliah.*') ? 'text-white border-b-4 border-emerald-400 md:border-b-0 md:border-l-4 bg-emerald-800/50 font-semibold' : 'text-emerald-100/70 hover:text-white hover:bg-emerald-800/30' }} no-underline transition-colors">
                <i class="fas fa-chalkboard-teacher pr-0 md:pr-3 ml-4 {{ request()->routeIs('admin.kelas-kuliah.*') ? 'text-emerald-400' : '' }}"></i><span class="pb-1 md:pb-0 text-sm md:text-base block md:inline-block">Kelas Kuliah</span>
            </a>
        </li>
    </ul>
</div>
