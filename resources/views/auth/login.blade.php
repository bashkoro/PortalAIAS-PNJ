<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Portal Asesmen AI PNJ</title>
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">
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
    <!-- Left Side: Login Form -->
    <div class="w-full lg:w-1/2 flex flex-col justify-center px-8 sm:px-16 md:px-24 bg-white relative shadow-2xl z-10">
        
        <div class="absolute top-8 left-8 sm:left-12">
            <a href="{{ url('/') }}" class="text-sm font-medium text-gray-500 hover:text-emerald-600 transition-colors flex items-center gap-2">
                <i class="fas fa-arrow-left"></i> Kembali ke Beranda
            </a>
        </div>

        <div class="w-full max-w-md mx-auto mt-12">
            <div class="mb-10 text-center lg:text-left">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-8 h-8 rounded-lg bg-emerald-600 flex items-center justify-center shadow-md">
                        <span class="text-white font-bold text-sm">AI</span>
                    </div>
                    <span class="font-bold text-xl tracking-tight text-gray-900">Score<span class="text-emerald-600">PNJ</span></span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 tracking-tight mb-3">Selamat Datang</h1>
                <p class="text-gray-500 text-sm sm:text-base leading-relaxed">Masukkan kredensial Anda untuk mengakses sistem klasifikasi AI Score PNJ.</p>
            </div>

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-r-lg flex items-center shadow-sm">
                    <i class="fas fa-check-circle mr-3"></i>
                    <span class="text-sm font-medium">{{ session('success') }}</span>
                </div>
            @endif
            
            <form method="POST" action="{{ route('login.post') }}" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2" for="email">Alamat Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </div>
                        <input type="email" name="email" id="email" 
                               class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg text-sm shadow-sm placeholder-gray-400 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-colors" 
                               value="{{ old('email') }}" placeholder="email@example.com" required autofocus />
                    </div>
                    @if ($errors->has('email'))
                        <p class="text-red-500 text-xs font-medium mt-2"><i class="fas fa-exclamation-circle mr-1"></i> {{ $errors->first('email') }}</p>
                    @endif
                </div>
                
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label class="block text-sm font-semibold text-gray-700" for="password">Kata Sandi</label>
                    </div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input type="password" name="password" id="password" 
                               class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg text-sm shadow-sm placeholder-gray-400 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-colors" 
                               placeholder="••••••••" required />
                    </div>
                    @if ($errors->has('password'))
                        <p class="text-red-500 text-xs font-medium mt-2"><i class="fas fa-exclamation-circle mr-1"></i> {{ $errors->first('password') }}</p>
                    @endif
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember-me" name="remember" type="checkbox" class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300 rounded cursor-pointer">
                        <label for="remember-me" class="ml-2 block text-sm text-gray-700 cursor-pointer">Ingat saya</label>
                    </div>
                </div>
                
                <button type="submit" class="w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-lg shadow-md text-sm font-bold text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-all duration-300">
                    Masuk ke Portal <i class="fas fa-sign-in-alt ml-2"></i>
                </button>
            </form>

            <div class="mt-8 pt-6 border-t border-gray-100 text-center space-y-3">
                <p class="text-sm text-gray-600">
                    Belum punya akun? 
                    <a href="{{ route('register') }}" class="font-bold text-emerald-600 hover:text-emerald-800 transition-colors">Daftar di sini</a>
                </p>
                <p class="text-sm text-gray-600">
                    <a href="{{ route('password.request') }}" class="font-medium text-emerald-600 hover:text-emerald-800 transition-colors">Lupa Sandi?</a>
                </p>
            </div>
            
            <p class="mt-8 text-center text-xs text-gray-500">
                &copy; {{ date('Y') }} AI Score PNJ. Hak Cipta Dilindungi.
            </p>
        </div>
    </div>
    
    <!-- Right Side: Banner -->
    <div class="hidden lg:flex lg:w-1/2 bg-emerald-600 relative overflow-hidden items-center justify-center">
        <!-- Abstract Background Shapes -->
        <div class="absolute inset-0 bg-gradient-to-br from-emerald-700 to-emerald-900 opacity-90"></div>
        <div class="absolute -top-24 -left-24 w-96 h-96 rounded-full bg-emerald-600 mix-blend-multiply filter blur-2xl opacity-50 animate-blob"></div>
        <div class="absolute top-1/2 -right-24 w-96 h-96 rounded-full bg-green-500 mix-blend-multiply filter blur-2xl opacity-50 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-24 left-1/3 w-96 h-96 rounded-full bg-emerald-400 mix-blend-multiply filter blur-2xl opacity-50 animate-blob animation-delay-4000"></div>
        
        <div class="relative z-20 w-full max-w-lg px-8 text-center">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-2xl bg-white/10 backdrop-blur-md mb-8 border border-white/20 shadow-xl">
                <i class="fas fa-brain text-4xl text-white"></i>
            </div>
            <h2 class="text-4xl font-bold text-white mb-6 leading-tight">Integritas Akademik<br>di Era Kecerdasan Buatan</h2>
            <p class="text-emerald-50 text-lg leading-relaxed mb-10">
                Sistem klasifikasi AI Score memastikan penggunaan AI dalam tugas akademik menjadi lebih terstruktur, transparan, dan dapat dipertanggungjawabkan melalui pendekatan Sistem Pakar.
            </p>
            
            <!-- Cards decorative elements -->
            <div class="grid grid-cols-2 gap-4 text-left">
                <div class="bg-white/10 backdrop-blur-md border border-white/10 rounded-xl p-5 shadow-lg">
                    <i class="fas fa-shield-alt text-emerald-300 text-2xl mb-3"></i>
                    <h3 class="text-white font-semibold mb-1">Terstandarisasi</h3>
                    <p class="text-emerald-100 text-xs">Klasifikasi batas AI secara otomatis (Level 1-5).</p>
                </div>
                <div class="bg-white/10 backdrop-blur-md border border-white/10 rounded-xl p-5 shadow-lg">
                    <i class="fas fa-file-signature text-emerald-300 text-2xl mb-3"></i>
                    <h3 class="text-white font-semibold mb-1">Transparan</h3>
                    <p class="text-emerald-100 text-xs">Form deklarasi jujur untuk setiap penugasan mahasiswa.</p>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
