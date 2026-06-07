<!-- resources/views/layouts/sidebar.blade.php -->
<div class="bg-white border-r border-gray-200 h-16 fixed bottom-0 md:sticky md:top-0 md:h-screen z-30 w-full md:w-64 border-t md:border-t-0 overflow-y-auto">
    <div class="md:h-[73px] md:w-full md:flex md:items-center md:justify-center hidden border-b border-gray-200">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-blue-600 to-purple-600 flex items-center justify-center shadow-md">
                <span class="text-white font-bold text-sm">AI</span>
            </div>
            <span class="font-bold text-xl tracking-tight text-gray-900">Score<span class="text-blue-600">PNJ</span></span>
        </div>
    </div>
    <ul class="flex flex-row md:flex-col py-0 md:py-4 text-center md:text-left justify-around md:justify-start w-full h-full md:h-auto">
        <li class="flex-1 md:w-full md:mb-2">
            <a href="{{ route('admin.dashboard') }}" class="block py-3 md:py-3 pl-1 align-middle {{ request()->routeIs('admin.dashboard') ? 'text-blue-600 border-b-4 border-blue-600 md:border-b-0 md:border-l-4 bg-blue-50' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }} no-underline transition-colors">
                <i class="fas fa-chart-pie pr-0 md:pr-3 ml-4 {{ request()->routeIs('admin.dashboard') ? 'text-blue-600' : '' }}"></i><span class="pb-1 md:pb-0 text-sm md:text-base block md:inline-block {{ request()->routeIs('admin.dashboard') ? 'font-semibold' : '' }}">Dashboard</span>
            </a>
        </li>
        <li class="flex-1 md:w-full md:mb-2">
            <a href="{{ route('admin.users.index') }}" class="block py-3 md:py-3 pl-1 align-middle {{ request()->routeIs('admin.users.*') ? 'text-blue-600 border-b-4 border-blue-600 md:border-b-0 md:border-l-4 bg-blue-50' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }} no-underline transition-colors">
                <i class="fas fa-users pr-0 md:pr-3 ml-4 {{ request()->routeIs('admin.users.*') ? 'text-blue-600' : '' }}"></i><span class="pb-1 md:pb-0 text-sm md:text-base block md:inline-block {{ request()->routeIs('admin.users.*') ? 'font-semibold' : '' }}">Pengguna</span>
            </a>
        </li>
        <li class="flex-1 md:w-full md:mb-2">
            <a href="{{ route('admin.rules.index') }}" class="block py-3 md:py-3 pl-1 align-middle {{ request()->routeIs('admin.rules.*') || request()->routeIs('admin.aturan.*') ? 'text-blue-600 border-b-4 border-blue-600 md:border-b-0 md:border-l-4 bg-blue-50' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }} no-underline transition-colors">
                <i class="fas fa-cogs pr-0 md:pr-3 ml-4 {{ request()->routeIs('admin.rules.*') || request()->routeIs('admin.aturan.*') ? 'text-blue-600' : '' }}"></i><span class="pb-1 md:pb-0 text-sm md:text-base block md:inline-block {{ request()->routeIs('admin.rules.*') || request()->routeIs('admin.aturan.*') ? 'font-semibold' : '' }}">Aturan AIAS</span>
            </a>
        </li>
        <li class="flex-1 md:w-full md:mb-2">
            <a href="{{ route('admin.program-studi.index') }}" class="block py-3 md:py-3 pl-1 align-middle {{ request()->routeIs('admin.program-studi.*') ? 'text-blue-600 border-b-4 border-blue-600 md:border-b-0 md:border-l-4 bg-blue-50' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }} no-underline transition-colors">
                <i class="fas fa-graduation-cap pr-0 md:pr-3 ml-4 {{ request()->routeIs('admin.program-studi.*') ? 'text-blue-600' : '' }}"></i><span class="pb-1 md:pb-0 text-sm md:text-base block md:inline-block {{ request()->routeIs('admin.program-studi.*') ? 'font-semibold' : '' }}">Program Studi</span>
            </a>
        </li>
        <li class="flex-1 md:w-full md:mb-2">
            <a href="{{ route('admin.periode-akademik.index') }}" class="block py-3 md:py-3 pl-1 align-middle {{ request()->routeIs('admin.periode-akademik.*') ? 'text-blue-600 border-b-4 border-blue-600 md:border-b-0 md:border-l-4 bg-blue-50' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }} no-underline transition-colors">
                <i class="fas fa-calendar-alt pr-0 md:pr-3 ml-4 {{ request()->routeIs('admin.periode-akademik.*') ? 'text-blue-600' : '' }}"></i><span class="pb-1 md:pb-0 text-sm md:text-base block md:inline-block {{ request()->routeIs('admin.periode-akademik.*') ? 'font-semibold' : '' }}">Periode Akademik</span>
            </a>
        </li>
        <li class="flex-1 md:w-full md:mb-2">
            <a href="{{ route('admin.mata-kuliah.index') }}" class="block py-3 md:py-3 pl-1 align-middle {{ request()->routeIs('admin.mata-kuliah.*') ? 'text-blue-600 border-b-4 border-blue-600 md:border-b-0 md:border-l-4 bg-blue-50' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }} no-underline transition-colors">
                <i class="fas fa-book-open pr-0 md:pr-3 ml-4 {{ request()->routeIs('admin.mata-kuliah.*') ? 'text-blue-600' : '' }}"></i><span class="pb-1 md:pb-0 text-sm md:text-base block md:inline-block {{ request()->routeIs('admin.mata-kuliah.*') ? 'font-semibold' : '' }}">Mata Kuliah</span>
            </a>
        </li>
        <li class="flex-1 md:w-full md:mb-2">
            <a href="{{ route('admin.kelas-kuliah.index') }}" class="block py-3 md:py-3 pl-1 align-middle {{ request()->routeIs('admin.kelas-kuliah.*') ? 'text-blue-600 border-b-4 border-blue-600 md:border-b-0 md:border-l-4 bg-blue-50' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }} no-underline transition-colors">
                <i class="fas fa-chalkboard-teacher pr-0 md:pr-3 ml-4 {{ request()->routeIs('admin.kelas-kuliah.*') ? 'text-blue-600' : '' }}"></i><span class="pb-1 md:pb-0 text-sm md:text-base block md:inline-block {{ request()->routeIs('admin.kelas-kuliah.*') ? 'font-semibold' : '' }}">Kelas Kuliah</span>
            </a>
        </li>
    </ul>
</div>
