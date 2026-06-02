<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Portal Asesmen AI PNJ</title>
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
            <a href="{{ url('/') }}" class="text-sm font-medium text-gray-500 hover:text-blue-600 transition-colors flex items-center gap-2">
                <i class="fas fa-arrow-left"></i> Kembali ke Beranda
            </a>
        </div>

        <div class="w-full max-w-md mx-auto mt-12">
            <div class="mb-10 text-center lg:text-left">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-blue-600 to-purple-600 flex items-center justify-center shadow-md">
                        <span class="text-white font-bold text-sm">AI</span>
                    </div>
                    <span class="font-bold text-xl tracking-tight text-gray-900">Score<span class="text-blue-600">PNJ</span></span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 tracking-tight mb-3">Selamat Datang</h1>
                <p class="text-gray-500 text-sm sm:text-base leading-relaxed">Masukkan kredensial institusi Anda untuk mengakses sistem klasifikasi AI Score PNJ.</p>
            </div>
            
            <form method="POST" action="{{ route('login.post') }}" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2" for="email">Alamat Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </div>
                        <input type="email" name="email" id="email" 
                               class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg text-sm shadow-sm placeholder-gray-400 focus:outline-none focus:border-blue-600 focus:ring-1 focus:ring-blue-600 transition-colors" 
                               value="{{ old('email') }}" placeholder="email@pnj.ac.id" required autofocus />
                    </div>
                    @if ($errors->has('email'))
                        <p class="text-red-500 text-xs font-medium mt-2"><i class="fas fa-exclamation-circle mr-1"></i> {{ $errors->first('email') }}</p>
                    @endif
                </div>
                
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label class="block text-sm font-semibold text-gray-700" for="password">Kata Sandi</label>
                        <a href="#" class="text-sm font-medium text-blue-600 hover:text-blue-600 transition-colors">Lupa sandi?</a>
                    </div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input type="password" name="password" id="password" 
                               class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg text-sm shadow-sm placeholder-gray-400 focus:outline-none focus:border-blue-600 focus:ring-1 focus:ring-blue-600 transition-colors" 
                               placeholder="••••••••" required />
                    </div>
                    @if ($errors->has('password'))
                        <p class="text-red-500 text-xs font-medium mt-2"><i class="fas fa-exclamation-circle mr-1"></i> {{ $errors->first('password') }}</p>
                    @endif
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember-me" name="remember" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-600 border-gray-300 rounded cursor-pointer">
                        <label for="remember-me" class="ml-2 block text-sm text-gray-700 cursor-pointer">Ingat saya</label>
                    </div>
                </div>
                
                <button type="submit" class="w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-600 transition-all">
                    Masuk ke Portal <i class="fas fa-sign-in-alt ml-2"></i>
                </button>
                
                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-200"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-3 bg-white text-gray-500 font-medium">Atau masuk dengan</span>
                    </div>
                </div>
                
                <button type="button" class="w-full flex justify-center items-center py-3 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-semibold text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 transition-all">
                    <svg class="w-5 h-5 mr-3" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 15.02 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/><path d="M1 1h22v22H1z" fill="none"/></svg>
                    Google SSO
                </button>
            </form>
            
            <p class="mt-8 text-center text-xs text-gray-500">
                &copy; 2024 AI Score PNJ. Hak Cipta Dilindungi.
            </p>
        </div>
    </div>
    
    <!-- Right Side: Image/Banner -->
    <div class="hidden lg:flex lg:w-1/2 bg-blue-600 relative overflow-hidden items-center justify-center">
        <!-- Abstract Background Shapes -->
        <div class="absolute inset-0 bg-gradient-to-br from-blue-700 to-blue-900 opacity-90"></div>
        <div class="absolute -top-24 -left-24 w-96 h-96 rounded-full bg-blue-600 mix-blend-multiply filter blur-2xl opacity-50 animate-blob"></div>
        <div class="absolute top-1/2 -right-24 w-96 h-96 rounded-full bg-indigo-500 mix-blend-multiply filter blur-2xl opacity-50 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-24 left-1/3 w-96 h-96 rounded-full bg-blue-400 mix-blend-multiply filter blur-2xl opacity-50 animate-blob animation-delay-4000"></div>
        
        <div class="relative z-20 w-full max-w-lg px-8 text-center">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-2xl bg-white/10 backdrop-blur-md mb-8 border border-white/20 shadow-xl">
                <i class="fas fa-brain text-4xl text-white"></i>
            </div>
            <h2 class="text-4xl font-bold text-white mb-6 leading-tight">Integritas Akademik<br>di Era Kecerdasan Buatan</h2>
            <p class="text-blue-50 text-lg leading-relaxed mb-10">
                Sistem klasifikasi AI Score memastikan penggunaan AI dalam tugas akademik menjadi lebih terstruktur, transparan, dan dapat dipertanggungjawabkan melalui pendekatan Sistem Pakar.
            </p>
            
            <!-- Cards decorative elements -->
            <div class="grid grid-cols-2 gap-4 text-left">
                <div class="bg-white/10 backdrop-blur-md border border-white/10 rounded-xl p-5 shadow-lg">
                    <i class="fas fa-shield-alt text-blue-300 text-2xl mb-3"></i>
                    <h3 class="text-white font-semibold mb-1">Terstandarisasi</h3>
                    <p class="text-blue-200 text-xs">Klasifikasi batas AI secara otomatis (Level 1-5).</p>
                </div>
                <div class="bg-white/10 backdrop-blur-md border border-white/10 rounded-xl p-5 shadow-lg">
                    <i class="fas fa-file-signature text-blue-300 text-2xl mb-3"></i>
                    <h3 class="text-white font-semibold mb-1">Transparan</h3>
                    <p class="text-blue-200 text-xs">Form deklarasi jujur untuk setiap penugasan mahasiswa.</p>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>