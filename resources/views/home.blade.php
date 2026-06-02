<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Asesmen AI - PNJ</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .gradient-text {
            background: linear-gradient(135deg, #2563eb 0%, #7c3aed 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .bg-grid-pattern {
            background-size: 40px 40px;
            background-image: linear-gradient(to right, rgba(0, 0, 0, 0.05) 1px, transparent 1px),
                              linear-gradient(to bottom, rgba(0, 0, 0, 0.05) 1px, transparent 1px);
        }
        .glass-nav {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
    </style>
</head>
<body class="bg-white text-gray-900 antialiased selection:bg-blue-600 selection:text-white overflow-x-hidden">

<!-- Navbar -->
<header class="glass-nav fixed top-0 w-full z-50 border-b border-gray-100 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-blue-600 flex items-center justify-center shadow-lg shadow-blue-200">
                    <span class="text-white font-bold text-xl">AI</span>
                </div>
                <span class="font-bold text-xl tracking-tight text-gray-900">Score<span class="text-blue-600">PNJ</span></span>
            </div>
            
            <nav class="hidden md:flex space-x-8">
                <a href="#fitur" class="text-gray-600 hover:text-blue-600 font-medium transition-colors">Fitur</a>
                <a href="#cara-kerja" class="text-gray-600 hover:text-blue-600 font-medium transition-colors">Cara Kerja</a>
                <a href="#tentang" class="text-gray-600 hover:text-blue-600 font-medium transition-colors">Tentang</a>
            </nav>

            <div class="flex items-center">
                @auth
                    @php
                        $dashboardRoute = 'mahasiswa.dashboard';
                        if (Auth::user()->checkRole('Admin')) $dashboardRoute = 'admin.dashboard';
                        elseif (Auth::user()->checkRole('Dosen')) $dashboardRoute = 'dosen.dashboard';
                    @endphp
                    <a href="{{ route($dashboardRoute) }}" class="inline-flex items-center justify-center px-6 py-2.5 text-sm font-semibold text-white transition-all duration-200 bg-gray-900 rounded-full hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900">
                        Dashboard <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-6 py-2.5 text-sm font-semibold text-white transition-all duration-200 bg-blue-600 rounded-full hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-600">
                        Masuk Portal <i class="fas fa-sign-in-alt ml-2"></i>
                    </a>
                @endauth
            </div>
        </div>
    </div>
</header>

<main class="pt-20">
    <!-- Hero Section -->
    <section class="relative bg-white pt-20 pb-32 overflow-hidden border-b border-gray-100">
        <div class="absolute inset-0 bg-grid-pattern opacity-40"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center z-10">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-50 border border-blue-100 text-blue-700 text-sm font-medium mb-8">
                <span class="flex h-2 w-2 rounded-full bg-blue-600"></span>
                Sistem Integritas Akademik Terpusat
            </div>
            
            <h1 class="text-5xl md:text-6xl lg:text-7xl font-extrabold tracking-tight mb-8 leading-tight">
                Masa Depan <br class="hidden md:block" />
                <span class="gradient-text">Integritas Akademik</span>
            </h1>
            
            <p class="mt-6 text-xl text-gray-600 max-w-3xl mx-auto mb-10 leading-relaxed">
                Memfasilitasi dosen dan mahasiswa dalam menerapkan kerangka kerja AIAS untuk mengotomatiskan klasifikasi batas penggunaan AI pada tugas perkuliahan secara transparan dan adil.
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                @auth
                    <a href="{{ route($dashboardRoute) }}" class="inline-flex items-center justify-center px-8 py-4 text-base font-bold text-white transition-all duration-200 bg-blue-600 rounded-full shadow-lg shadow-blue-200 hover:bg-blue-700 hover:-translate-y-0.5">
                        Buka Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-8 py-4 text-base font-bold text-white transition-all duration-200 bg-blue-600 rounded-full shadow-lg shadow-blue-200 hover:bg-blue-700 hover:-translate-y-0.5">
                        Mulai Sekarang
                    </a>
                @endauth
                <a href="#fitur" class="inline-flex items-center justify-center px-8 py-4 text-base font-bold text-gray-700 transition-all duration-200 bg-white border border-gray-200 rounded-full shadow-sm hover:bg-gray-50">
                    Pelajari Lebih Lanjut
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="fitur" class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-sm font-bold text-blue-600 uppercase tracking-widest mb-3">Solusi Inti</h2>
                <h3 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">Sistem Cerdas, Transparan, & Terpercaya</h3>
                <p class="text-lg text-gray-600">Menjembatani kesenjangan antara pesatnya penggunaan AI dan regulasi akademik melalui pendekatan sistematis.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 hover:shadow-xl transition-all duration-300">
                    <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-microchip text-2xl"></i>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-3">Mesin Klasifikasi AIAS</h4>
                    <p class="text-gray-600 leading-relaxed">Secara otomatis menentukan batasan AI Score yang diizinkan untuk setiap kriteria tugas berdasarkan aturan yang ditetapkan.</p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 hover:shadow-xl transition-all duration-300">
                    <div class="w-14 h-14 bg-green-50 text-green-600 rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-file-contract text-2xl"></i>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-3">Deklarasi Mandiri</h4>
                    <p class="text-gray-600 leading-relaxed">Fasilitas terstruktur bagi mahasiswa untuk melaporkan secara jujur sejauh mana penggunaan AI dalam penyelesaian tugas.</p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 hover:shadow-xl transition-all duration-300">
                    <div class="w-14 h-14 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-chart-line text-2xl"></i>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-3">Pemantauan & Analitik</h4>
                    <p class="text-gray-600 leading-relaxed">Dashboard komprehensif untuk dosen melacak tingkat kepatuhan dan tren penggunaan AI pada setiap kelas.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section id="cara-kerja" class="py-24 bg-white relative overflow-hidden border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-20">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">Alur Kerja Sistem</h2>
                <p class="text-lg text-gray-600">Sederhana, terarah, dan mengutamakan transparansi antara dosen dan mahasiswa.</p>
            </div>

            <div class="relative">
                <div class="hidden md:block absolute top-12 left-[10%] right-[10%] h-0.5 bg-gray-200 z-0"></div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-12 relative z-10">
                    <div class="text-center">
                        <div class="w-24 h-24 mx-auto bg-white rounded-full flex items-center justify-center mb-6 shadow-lg border-4 border-white ring-1 ring-gray-100">
                            <span class="text-3xl font-black text-gray-900">1</span>
                        </div>
                        <h4 class="text-xl font-bold text-gray-900 mb-4">Input Kriteria</h4>
                        <p class="text-gray-600 px-4">Dosen membuat tugas dan menetapkan kriteria serta parameter penilaian ke dalam sistem.</p>
                    </div>
                    <div class="text-center">
                        <div class="w-24 h-24 mx-auto bg-blue-600 rounded-full flex items-center justify-center mb-6 shadow-lg border-4 border-white">
                            <span class="text-3xl font-black text-white">2</span>
                        </div>
                        <h4 class="text-xl font-bold text-gray-900 mb-4">Klasifikasi AI</h4>
                        <p class="text-gray-600 px-4">Mesin aturan memproses kriteria dan menghasilkan batas maksimal tingkat AI yang diizinkan.</p>
                    </div>
                    <div class="text-center">
                        <div class="w-24 h-24 mx-auto bg-gray-900 rounded-full flex items-center justify-center mb-6 shadow-lg border-4 border-white">
                            <span class="text-3xl font-black text-white">3</span>
                        </div>
                        <h4 class="text-xl font-bold text-gray-900 mb-4">Deklarasi Mahasiswa</h4>
                        <p class="text-gray-600 px-4">Mahasiswa mengerjakan tugas dan mengisi form deklarasi penggunaan AI sebelum pengumpulan.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<footer class="bg-gray-900 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="flex justify-center items-center gap-3 mb-6">
            <div class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center">
                <span class="text-white font-bold text-sm">AI</span>
            </div>
            <span class="font-bold text-xl tracking-tight text-white">Score<span class="text-blue-400">PNJ</span></span>
        </div>
        <p class="text-gray-400 text-sm mb-6">© {{ date('Y') }} Portal Asesmen AI PNJ. Hak Cipta Dilindungi.</p>
        <div class="flex justify-center gap-6">
            <a href="#" class="text-gray-500 hover:text-white transition-colors text-xs uppercase tracking-widest font-bold">Privasi</a>
            <a href="#" class="text-gray-500 hover:text-white transition-colors text-xs uppercase tracking-widest font-bold">Syarat</a>
        </div>
    </div>
</footer>

<script>
    window.addEventListener('scroll', () => {
        const nav = document.querySelector('header');
        if (window.scrollY > 10) {
            nav.classList.add('shadow-md');
        } else {
            nav.classList.remove('shadow-md');
        }
    });
</script>

</body>
</html>
