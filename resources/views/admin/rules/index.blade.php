<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Aturan - Portal Asesmen AI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

<div class="flex flex-col md:flex-row">

    <!-- Sidebar -->
    <div class="bg-white border-r border-gray-200 h-16 fixed bottom-0 md:sticky md:top-0 md:h-screen z-30 w-full md:w-64 border-t md:border-t-0">
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
                <a href="{{ route('admin.dashboard') }}" class="block py-3 md:py-3 pl-1 align-middle text-gray-500 no-underline border-b-4 border-transparent md:border-l-4 hover:border-gray-300 md:hover:border-gray-300 hover:bg-gray-50 hover:text-gray-700 transition-colors">
                    <i class="fas fa-chart-pie pr-0 md:pr-3 ml-4"></i><span class="pb-1 md:pb-0 text-sm md:text-base block md:inline-block">Dashboard</span>
                </a>
            </li>
            <li class="flex-1 md:w-full md:mb-2">
                <a href="{{ route('admin.users.index') }}" class="block py-3 md:py-3 pl-1 align-middle text-gray-500 no-underline border-b-4 border-transparent md:border-l-4 hover:border-gray-300 md:hover:border-gray-300 hover:bg-gray-50 hover:text-gray-700 transition-colors">
                    <i class="fas fa-users pr-0 md:pr-3 ml-4"></i><span class="pb-1 md:pb-0 text-sm md:text-base block md:inline-block">Pengguna</span>
                </a>
            </li>
            <li class="flex-1 md:w-full md:mb-2">
                <a href="{{ route('admin.rules.index') }}" class="block py-3 md:py-3 pl-1 align-middle text-blue-600 no-underline border-b-4 border-blue-600 md:border-b-0 md:border-l-4 hover:bg-gray-50 transition-colors bg-blue-50">
                    <i class="fas fa-cogs pr-0 md:pr-3 text-blue-600 ml-4"></i><span class="pb-1 md:pb-0 text-sm md:text-base text-blue-600 font-medium md:font-semibold block md:inline-block">Aturan AIAS</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content flex-1 bg-gray-100 mt-12 md:mt-0 pb-24 md:pb-5">

        <!-- Header -->
        <div class="bg-white border-b border-gray-200 w-full p-4 flex justify-between items-center sticky top-0 z-20 h-[73px]">
            <h1 class="text-xl md:text-2xl font-bold text-gray-800 hidden md:block">Knowledge Base (Basis Aturan)</h1>
            <div class="md:hidden">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-blue-600 to-purple-600 flex items-center justify-center shadow-md">
                        <span class="text-white font-bold text-sm">AI</span>
                    </div>
                    <span class="font-bold text-xl tracking-tight text-gray-900">Score<span class="text-blue-600">PNJ</span></span>
                </div>
            </div>
            <div class="flex items-center">
                <span class="text-gray-600 mr-4 font-medium">{{ Auth::user()->nama ?? 'Administrator' }}</span>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-red-500 hover:text-red-700 font-semibold text-sm transition-colors border border-red-200 hover:border-red-300 px-3 py-1.5 rounded-md hover:bg-red-50">
                        <i class="fas fa-sign-out-alt mr-1"></i>Keluar
                    </button>
                </form>
            </div>
        </div>

        <div class="p-4 md:p-8">

            <div class="bg-white shadow-sm rounded-lg border border-gray-100 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
                    <div>
                        <h3 class="font-bold text-gray-800 text-lg">Daftar Logika Forward Chaining</h3>
                        <p class="text-sm text-gray-500">Logika IF-THEN yang digunakan sistem untuk menentukan batas AI Score tugas.</p>
                    </div>
                    <button class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold py-2 px-4 rounded shadow transition-colors">
                        <i class="fas fa-plus mr-2"></i>Tambah Aturan
                    </button>
                </div>
                
                <div class="p-6 space-y-6">
                    @forelse($aturan as $rule)
                    <div class="border border-gray-200 rounded-lg p-5 bg-white hover:shadow-md transition-shadow relative">
                        <div class="absolute top-4 right-4">
                            <span class="{{ $rule->is_active ? 'bg-blue-50 text-green-800' : 'bg-red-100 text-red-800' }} text-xs font-semibold px-2.5 py-0.5 rounded">
                                {{ $rule->is_active ? 'Aktif' : 'Tidak Aktif' }}
                            </span>
                        </div>
                        
                        <div class="flex flex-col md:flex-row items-start md:items-center gap-4">
                            <div class="flex-1">
                                <div class="font-mono text-sm bg-gray-50 p-4 rounded border border-gray-100">
                                    <span class="text-blue-600 font-bold">JIKA (IF)</span><br>
                                    @foreach($rule->kondisiAturan as $index => $kondisi)
                                        <span class="ml-4">
                                            <span class="text-blue-700">{{ $kondisi->nama_parameter }}</span> 
                                            <span class="text-gray-500">{{ $kondisi->operator }}</span> 
                                            <span class="text-blue-700">"{{ $kondisi->target_value }}"</span>
                                        </span>
                                        @if(!$loop->last)
                                            <br><span class="text-gray-700 font-bold ml-4">DAN (AND)</span><br>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            
                            <div class="hidden md:block text-gray-400">
                                <i class="fas fa-arrow-right text-2xl"></i>
                            </div>
                            <div class="md:hidden text-gray-400 self-center my-2">
                                <i class="fas fa-arrow-down text-xl"></i>
                            </div>

                            <div class="w-full md:w-48 bg-blue-50 border border-blue-50 rounded-lg p-4 text-center">
                                <span class="text-blue-700 font-bold text-sm block mb-1">MAKA HASILNYA (THEN)</span>
                                <span class="text-xl font-black text-gray-900 block">{{ $rule->tingkatAias->nama_tingkat ?? 'Tidak Diketahui' }}</span>
                            </div>
                            
                            <div class="flex md:flex-col gap-2 w-full md:w-auto justify-end mt-2 md:mt-0">
                                <button class="p-2 text-gray-500 hover:text-blue-600 bg-gray-100 hover:bg-blue-50 rounded transition-colors" title="Edit Aturan">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form method="POST" action="{{ route('admin.aturan.destroy', $rule->id) }}" class="inline" onsubmit="return confirm('Yakin ingin menonaktifkan aturan ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-gray-500 hover:text-red-600 bg-gray-100 hover:bg-red-50 rounded transition-colors" title="Hapus Aturan">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-8 text-gray-500">
                        <i class="fas fa-database text-4xl mb-3 text-gray-300"></i>
                        <p>Belum ada aturan di dalam Knowledge Base.</p>
                    </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>