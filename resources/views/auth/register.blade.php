<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Portal Asesmen AI PNJ</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
        .animate-blob {
            animation: blob 7s infinite;
        }
        .animation-delay-2000 {
            animation-delay: 2s;
        }
        .animation-delay-4000 {
            animation-delay: 4s;
        }
    </style>
</head>
<body class="bg-gray-50 font-sans text-gray-800 antialiased">

<div class="min-h-screen flex">
    <!-- Left Side: Banner (Visible on Large Screens) -->
    <div class="hidden lg:flex lg:w-1/2 bg-blue-600 relative overflow-hidden items-center justify-center">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-700 to-blue-900 opacity-90"></div>
        <div class="absolute -top-24 -left-24 w-96 h-96 rounded-full bg-blue-600 mix-blend-multiply filter blur-2xl opacity-50 animate-blob"></div>
        <div class="absolute top-1/2 -right-24 w-96 h-96 rounded-full bg-indigo-500 mix-blend-multiply filter blur-2xl opacity-50 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-24 left-1/3 w-96 h-96 rounded-full bg-blue-400 mix-blend-multiply filter blur-2xl opacity-50 animate-blob animation-delay-4000"></div>
        
        <div class="relative z-20 w-full max-w-lg px-8 text-center">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-2xl bg-white/10 backdrop-blur-md mb-8 border border-white/20 shadow-xl">
                <i class="fas fa-user-plus text-4xl text-white"></i>
            </div>
            <h2 class="text-4xl font-bold text-white mb-6 leading-tight">Bergabung dengan Kami</h2>
            <p class="text-blue-50 text-lg leading-relaxed mb-10">
                Daftarkan akun Anda untuk mulai menggunakan sistem klasifikasi AI Score dan menjaga integritas akademik bersama.
            </p>
        </div>
    </div>

    <!-- Right Side: Register Form -->
    <div class="w-full lg:w-1/2 flex flex-col justify-center px-8 sm:px-16 md:px-24 bg-white relative shadow-2xl z-10">
        
        <div class="absolute top-8 right-8 sm:right-12">
            <a href="{{ url('/') }}" class="text-sm font-medium text-gray-500 hover:text-blue-600 transition-colors flex items-center gap-2">
                Kembali ke Beranda <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <div class="w-full max-w-md mx-auto py-12">
            <div class="mb-10 text-center lg:text-left">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-blue-600 to-purple-600 flex items-center justify-center shadow-md">
                        <span class="text-white font-bold text-sm">AI</span>
                    </div>
                    <span class="font-bold text-xl tracking-tight text-gray-900">Score<span class="text-blue-600">PNJ</span></span>
                </div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight mb-3">Buat Akun Baru</h1>
                <p class="text-gray-500 text-sm">Silakan lengkapi data di bawah ini untuk mendaftar.</p>
            </div>
            
            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1" for="nama">Nama Lengkap</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-user text-gray-400 text-xs"></i>
                        </div>
                        <input type="text" name="nama" id="nama" 
                               class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg text-sm shadow-sm placeholder-gray-400 focus:outline-none focus:border-blue-600 focus:ring-1 focus:ring-blue-600 transition-colors" 
                               value="{{ old('nama') }}" placeholder="Nama Lengkap Anda" required />
                    </div>
                    @error('nama')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1" for="email">Alamat Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-400 text-xs"></i>
                        </div>
                        <input type="email" name="email" id="email" 
                               class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg text-sm shadow-sm placeholder-gray-400 focus:outline-none focus:border-blue-600 focus:ring-1 focus:ring-blue-600 transition-colors" 
                               value="{{ old('email') }}" placeholder="email@example.com" required />
                    </div>
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1" for="hak_akses">Peran</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-user-tag text-gray-400 text-xs"></i>
                            </div>
                            <select name="hak_akses" id="hak_akses" 
                                    class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg text-sm shadow-sm focus:outline-none focus:border-blue-600 focus:ring-1 focus:ring-blue-600 transition-colors appearance-none bg-white" 
                                    required>
                                <option value="">-- Pilih --</option>
                                <option value="Mahasiswa" {{ old('hak_akses') == 'Mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                                <option value="Dosen" {{ old('hak_akses') == 'Dosen' ? 'selected' : '' }}>Dosen</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1" for="program_studi_id">Program Studi</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-graduation-cap text-gray-400 text-xs"></i>
                            </div>
                            <select name="program_studi_id" id="program_studi_id" 
                                    class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg text-sm shadow-sm focus:outline-none focus:border-blue-600 focus:ring-1 focus:ring-blue-600 transition-colors appearance-none bg-white" 
                                    required>
                                <option value="">-- Pilih --</option>
                                @foreach($programStudi as $prodi)
                                    <option value="{{ $prodi->id }}" {{ old('program_studi_id') == $prodi->id ? 'selected' : '' }}>
                                        {{ $prodi->nama_prodi }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    @error('hak_akses')
                        <p class="text-red-500 text-xs">{{ $message }}</p>
                    @enderror
                    @error('program_studi_id')
                        <p class="text-red-500 text-xs">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1" for="password">Kata Sandi</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400 text-xs"></i>
                            </div>
                            <input type="password" name="password" id="password" 
                                   class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg text-sm shadow-sm placeholder-gray-400 focus:outline-none focus:border-blue-600 focus:ring-1 focus:ring-blue-600 transition-colors" 
                                   placeholder="••••••••" required />
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1" for="password_confirmation">Konfirmasi</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-check-double text-gray-400 text-xs"></i>
                            </div>
                            <input type="password" name="password_confirmation" id="password_confirmation" 
                                   class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg text-sm shadow-sm placeholder-gray-400 focus:outline-none focus:border-blue-600 focus:ring-1 focus:ring-blue-600 transition-colors" 
                                   placeholder="••••••••" required />
                        </div>
                    </div>
                </div>
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
                
                <button type="submit" class="w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-600 transition-all mt-2">
                    Daftar Sekarang <i class="fas fa-user-plus ml-2"></i>
                </button>
            </form>

            <div class="mt-8 pt-6 border-t border-gray-100 text-center">
                <p class="text-sm text-gray-600">
                    Sudah punya akun? 
                    <a href="{{ route('login') }}" class="font-bold text-blue-600 hover:text-blue-700 transition-colors">Masuk di sini</a>
                </p>
            </div>
            
            <p class="mt-8 text-center text-xs text-gray-500">
                &copy; {{ date('Y') }} AI Score PNJ. Hak Cipta Dilindungi.
            </p>
        </div>
    </div>
</div>

</body>
</html>
