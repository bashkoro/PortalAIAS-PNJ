<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Portal Asesmen AI PNJ</title>
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="antialiased bg-gradient-to-br from-[#0d2b1a] via-[#1a3d28] to-[#276040] min-h-screen flex flex-col">

    <!-- Navigation (Optional/Minimal) -->
    <header class="w-full p-6 flex justify-end">
        @if (Route::has('login'))
            <div class="space-x-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-emerald-100 hover:text-white font-medium transition-colors">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-emerald-100 hover:text-white font-medium transition-colors">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="text-emerald-100 hover:text-white font-medium transition-colors">Register</a>
                    @endif
                @endauth
            </div>
        @endif
    </header>

    <!-- Hero Section -->
    <main class="flex-grow flex items-center justify-center px-6">
        <div class="max-w-4xl w-full text-center">
            
            <!-- Eyebrow Badge -->
            <div class="inline-flex items-center justify-center mb-8">
                <span class="bg-emerald-900/50 text-emerald-300 border border-emerald-700/50 rounded-full px-4 py-1.5 text-sm font-semibold tracking-wide shadow-sm">
                    <i class="fas fa-shield-alt mr-2"></i> Portal Asesmen AI Terintegrasi
                </span>
            </div>
            
            <!-- Title -->
            <h1 class="text-5xl md:text-6xl lg:text-7xl font-extrabold text-white tracking-tight mb-6">
                AIAS <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-emerald-200">PNJ</span><br/>
                <span class="text-3xl md:text-4xl lg:text-5xl font-bold mt-2 block">Rule-Based Classification</span>
            </h1>
            
            <!-- Subtitle -->
            <p class="mt-6 text-lg md:text-xl text-emerald-50 max-w-2xl mx-auto leading-relaxed font-light">
                Sistem pendataan dan klasifikasi penggunaan Artificial Intelligence untuk lingkungan akademik Politeknik Negeri Jakarta. Menjaga integritas melalui transparansi.
            </p>
            
            <!-- Call to Action Buttons -->
            <div class="mt-12 flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="{{ route('login') }}" class="w-full sm:w-auto bg-emerald-500 hover:bg-emerald-400 text-white rounded-xl shadow-lg shadow-emerald-900/20 px-8 py-3.5 font-semibold text-lg transition-all duration-300 transform hover:-translate-y-1">
                    Masuk ke Portal <i class="fas fa-arrow-right ml-2"></i>
                </a>
                
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="w-full sm:w-auto bg-transparent border border-emerald-400 text-emerald-300 hover:bg-emerald-800/30 hover:text-emerald-200 rounded-xl px-8 py-3.5 font-semibold text-lg transition-all duration-300">
                        Daftar Akun
                    </a>
                @endif
            </div>
            
            <!-- Footer text -->
            <div class="mt-16 text-emerald-500/60 text-sm font-medium">
                &copy; {{ date('Y') }} Politeknik Negeri Jakarta. Hak Cipta Dilindungi.
            </div>
        </div>
    </main>

</body>
</html>
