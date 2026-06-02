<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Asesmen AI - PNJ</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
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
<body class="bg-gray-50 text-gray-900 antialiased selection:bg-blue-500 selection:text-white overflow-x-hidden">

<!-- Navbar -->
<header class="glass-nav fixed top-0 w-full z-50 border-b border-gray-100 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-600 to-purple-600 flex items-center justify-center shadow-lg shadow-blue-500/30">
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
                <a href="{{ route('login') }}" class="group relative inline-flex items-center justify-center px-6 py-2.5 text-sm font-semibold text-white transition-all duration-200 bg-gray-900 border border-transparent rounded-full hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 overflow-hidden">
                    <span class="relative z-10 flex items-center gap-2">
                        Masuk Portal
                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </span>
                </a>
            </div>
        </div>
    </div>
</header>

<main class="pt-20">
    <!-- Hero Section -->
    <section class="relative bg-white pt-20 pb-32 overflow-hidden border-b border-gray-100">
        <div class="absolute inset-0 bg-grid-pattern opacity-40"></div>
        <div class="absolute top-0 right-0 -translate-y-12 translate-x-1/3">
            <div class="w-96 h-96 bg-blue-100 rounded-full blur-3xl opacity-50"></div>
        </div>
        <div class="absolute bottom-0 left-0 translate-y-1/3 -translate-x-1/3">
            <div class="w-96 h-96 bg-blue-50 rounded-full blur-3xl opacity-50"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center z-10">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-50 border border-blue-100 text-blue-700 text-sm font-medium mb-8 shadow-sm">
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
                <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-8 py-4 text-base font-bold text-white transition-all duration-200 bg-blue-600 border border-transparent rounded-full shadow-lg shadow-blue-500/30 hover:bg-blue-700 hover:shadow-blue-500/50 hover:-translate-y-0.5">
                    Mulai Sekarang
                </a>
                <a href="#fitur" class="inline-flex items-center justify-center px-8 py-4 text-base font-bold text-gray-700 transition-all duration-200 bg-white border border-gray-200 rounded-full shadow-sm hover:bg-gray-50 hover:border-gray-300">
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
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 hover:shadow-xl hover:border-blue-100 transition-all duration-300 group hover:-translate-y-1">
                    <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center mb-6 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-3">Mesin Klasifikasi AIAS</h4>
                    <p class="text-gray-600 leading-relaxed">Secara otomatis menentukan batasan AI Score yang diizinkan untuk setiap kriteria tugas berdasarkan aturan yang ditetapkan.</p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 hover:shadow-xl hover:border-green-100 transition-all duration-300 group hover:-translate-y-1">
                    <div class="w-14 h-14 bg-green-50 text-green-600 rounded-xl flex items-center justify-center mb-6 group-hover:bg-green-600 group-hover:text-white transition-colors">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-3">Deklarasi Mandiri</h4>
                    <p class="text-gray-600 leading-relaxed">Fasilitas terstruktur bagi mahasiswa untuk melaporkan secara jujur sejauh mana penggunaan AI dalam penyelesaian tugas.</p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 hover:shadow-xl hover:border-purple-100 transition-all duration-300 group hover:-translate-y-1">
                    <div class="w-14 h-14 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center mb-6 group-hover:bg-purple-600 group-hover:text-white transition-colors">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
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
                <!-- Connecting Line -->
                <div class="hidden md:block absolute top-12 left-[10%] right-[10%] h-0.5 bg-gradient-to-r from-gray-200 via-blue-300 to-gray-200 z-0"></div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-12 relative z-10">
                    <!-- Step 1 -->
                    <div class="text-center relative">
                        <div class="w-24 h-24 mx-auto bg-white rounded-full flex items-center justify-center mb-6 shadow-xl shadow-gray-200/50 border-4 border-white ring-1 ring-gray-100">
                            <span class="text-3xl font-black text-gray-900">1</span>
                        </div>
                        <h4 class="text-xl font-bold text-gray-900 mb-4">Input Kriteria</h4>
                        <p class="text-gray-600 px-4">Dosen membuat tugas dan menetapkan kriteria serta parameter penilaian ke dalam sistem.</p>
                    </div>

                    <!-- Step 2 -->
                    <div class="text-center relative">
                        <div class="w-24 h-24 mx-auto bg-blue-600 rounded-full flex items-center justify-center mb-6 shadow-xl shadow-blue-500/30 border-4 border-white">
                            <span class="text-3xl font-black text-white">2</span>
                        </div>
                        <h4 class="text-xl font-bold text-gray-900 mb-4">Klasifikasi AI</h4>
                        <p class="text-gray-600 px-4">Mesin aturan memproses kriteria dan menghasilkan batas maksimal tingkat AI yang diizinkan.</p>
                    </div>

                    <!-- Step 3 -->
                    <div class="text-center relative">
                        <div class="w-24 h-24 mx-auto bg-gray-900 rounded-full flex items-center justify-center mb-6 shadow-xl shadow-gray-900/30 border-4 border-white">
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

<footer class="bg-gray-900 text-white py-12 border-t border-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
            <div class="col-span-1 lg:col-span-2">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-blue-600 to-purple-600 flex items-center justify-center">
                        <span class="text-white font-bold text-sm">AI</span>
                    </div>
                    <span class="font-bold text-xl tracking-tight text-white">Score<span class="text-blue-400">PNJ</span></span>
                </div>
                <p class="text-gray-400 max-w-sm mb-6">Mewujudkan lingkungan akademik yang menjunjung tinggi integritas di era kecerdasan buatan.</p>
            </div>
            
            <div>
                <h4 class="text-lg font-semibold mb-4">Tautan</h4>
                <ul class="space-y-3">
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Beranda</a></li>
                    <li><a href="#fitur" class="text-gray-400 hover:text-white transition-colors">Fitur</a></li>
                    <li><a href="#cara-kerja" class="text-gray-400 hover:text-white transition-colors">Cara Kerja</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-lg font-semibold mb-4">Kontak</h4>
                <ul class="space-y-3">
                    <li class="text-gray-400">Politeknik Negeri Jakarta</li>
                    <li class="text-gray-400">Jl. Prof. DR. G.A. Siwabessy, Kampus Universitas Indonesia Depok 16425</li>
                </ul>
            </div>
        </div>
        
        <div class="pt-8 border-t border-gray-800 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-gray-500 text-sm">© {{ date('Y') }} Portal Asesmen AI PNJ. Hak Cipta Dilindungi.</p>
            <div class="flex gap-4">
                <a href="#" class="text-gray-500 hover:text-white transition-colors text-sm">Kebijakan Privasi</a>
                <a href="#" class="text-gray-500 hover:text-white transition-colors text-sm">Syarat & Ketentuan</a>
            </div>
        </div>
    </div>
</footer>

<script>
    // Simple script for glass navbar effect on scroll
    window.addEventListener('scroll', () => {
        const nav = document.querySelector('header');
        if (window.scrollY > 10) {
            nav.classList.add('shadow-sm');
        } else {
            nav.classList.remove('shadow-sm');
        }
    });
</script>

</body>
</html>