<!-- resources/views/layouts/dosen-header.blade.php -->
<div class="bg-white border-b border-gray-200 w-full p-4 flex justify-between items-center sticky top-0 z-20 h-[73px]">
    <h1 class="text-xl md:text-2xl font-bold text-gray-800 hidden md:block">@yield('title', 'Dashboard Dosen')</h1>
    <div class="md:hidden">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-emerald-600 flex items-center justify-center shadow-md">
                <span class="text-white font-bold text-sm">AI</span>
            </div>
            <span class="font-bold text-xl tracking-tight text-gray-900">Score<span class="text-emerald-600">PNJ</span></span>
        </div>
    </div>
    <div class="flex items-center" x-data="{ open: false }">
        <div class="relative">
            <button @click="open = !open" @click.away="open = false" class="flex items-center gap-2 text-sm font-medium text-gray-700 hover:text-gray-900 focus:outline-none transition duration-150 ease-in-out">
                <span class="text-gray-600 font-medium hidden md:block">{{ Auth::user()->nama ?? 'Dosen Tester' }}</span>
                <img class="h-8 w-8 rounded-full object-cover border border-gray-300 shadow-sm" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->nama ?? 'Dosen') }}&color=047857&background=ecfdf5" alt="Profile">
                <i class="fas fa-chevron-down text-xs text-gray-400"></i>
            </button>

            <div x-show="open" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="transform opacity-0 scale-95"
                 x-transition:enter-end="transform opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-75"
                 x-transition:leave-start="transform opacity-100 scale-100"
                 x-transition:leave-end="transform opacity-0 scale-95"
                 class="absolute right-0 mt-2 w-56 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 z-50"
                 style="display: none;">
                
                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition border-b border-gray-50">
                    <i class="fas fa-user-circle mr-2 text-emerald-600 w-4"></i> Pengaturan Profil
                </a>
                
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition">
                        <i class="fas fa-sign-out-alt mr-2 w-4"></i> Keluar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
