@extends('layouts.dosen')

@section('title', 'Buat Penugasan Baru')


@section('content')
    <div class="max-w-4xl mx-auto">
        
        <div class="mb-6">
            <a href="javascript:history.back()" class="text-sm font-medium text-gray-500 hover:text-emerald-600 transition-colors flex items-center gap-2">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        @if($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-r shadow-sm" role="alert">
                <p class="font-bold">Gagal Menyimpan Tugas</p>
                <ul class="list-disc ml-5 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="task-form" action="{{ route('dosen.tugas.store') }}" method="POST" class="bg-white shadow-[0_8px_30px_rgb(0,0,0,0.04)] rounded-2xl border border-gray-100/80 overflow-hidden">
            @csrf
            
            <div class="px-8 py-6 border-b border-gray-100/80 bg-white">
                <h3 class="font-bold text-gray-800 text-lg">Informasi Tugas & Kriteria Asesmen</h3>
                <p class="text-sm text-gray-500">Lengkapi detail dasar tugas beserta kriteria klasifikasi AI-nya.</p>
            </div>
            <div class="p-6 space-y-6">
                <div>
                    <label for="kelas_kuliah_id" class="block text-sm font-medium text-gray-700 mb-2">Pilih Kelas Mata Kuliah <span class="text-red-500">*</span></label>
                    <select name="kelas_kuliah_id" id="kelas_kuliah_id" class="w-full bg-white border border-gray-300 text-gray-700 py-2 px-3 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-600 focus:border-transparent" required>
                        <option value="">-- Pilih Kelas --</option>
                        @foreach($kelasKuliah as $kelas)
                            <option value="{{ $kelas->id }}" {{ (old('kelas_kuliah_id') == $kelas->id || request('kelas_id') == $kelas->id) ? 'selected' : '' }}>
                                {{ $kelas->mataKuliah->nama_mk }} - {{ $kelas->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">Judul Tugas <span class="text-red-500">*</span></label>
                    <input type="text" name="judul" id="judul" value="{{ old('judul') }}" class="w-full bg-white border border-gray-300 text-gray-700 py-2 px-3 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-600 focus:border-transparent" placeholder="Contoh: Makalah Analisis Algoritma" required>
                </div>
                <div>
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi/Instruksi Tugas <span class="text-red-500">*</span></label>
                    <textarea name="deskripsi" id="deskripsi" rows="4" class="w-full bg-white border border-gray-300 text-gray-700 py-2 px-3 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-600 focus:border-transparent" placeholder="Tuliskan instruksi pengerjaan tugas secara detail di sini..." required>{{ old('deskripsi') }}</textarea>
                </div>
                
                <hr class="border-gray-200">
                <h4 class="font-bold text-gray-800 text-md mb-2">Karakteristik Asesmen/Tugas</h4>
                <div class="grid grid-cols-1 gap-6">
                    <!-- Lingkungan Pengerjaan -->
                    <div>
                        <div class="flex items-center mb-2">
                            <label class="block text-sm font-medium text-gray-700">Lingkungan Pengerjaan <span class="text-red-500">*</span></label>
                            <div class="relative group ml-2 flex items-center">
                                <i class="fas fa-question-circle text-gray-400 hover:text-emerald-600 cursor-help transition-colors"></i>
                                <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 hidden group-hover:block w-72 p-3 bg-gray-800 text-white text-xs rounded-lg shadow-xl z-50 transition-opacity">
                                    <p class="font-semibold mb-1 border-b border-gray-600 pb-1">Keterangan:</p>
                                    <ul class="list-disc pl-4 space-y-1">
                                        <li><strong>Terbuka:</strong> Tugas dikerjakan tanpa pengawasan langsung, bebas mengakses berbagai sumber (internet, buku, dll).</li>
                                        <li><strong>Terkendali Penuh:</strong> Tugas dikerjakan dalam lingkungan yang diawasi ketat (misal: di kelas, menggunakan safe exam browser).</li>
                                    </ul>
                                    <div class="absolute top-full left-1/2 -translate-x-1/2 border-4 border-transparent border-t-gray-800"></div>
                                </div>
                            </div>
                        </div>
                        <select id="lingkungan_pengerjaan" name="kriteria_tugas[lingkungan_pengerjaan]" class="w-full bg-white border border-gray-300 text-gray-700 py-2 px-3 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-600 focus:border-transparent" required>
                            <option value="">-- Pilih Lingkungan Pengerjaan --</option>
                            @foreach($kriteriaOptions['lingkungan_pengerjaan'] as $option)
                                <option value="{{ $option }}" {{ old('kriteria_tugas.lingkungan_pengerjaan') == $option ? 'selected' : '' }}>
                                    {{ $option }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Tingkat Proses Kognitif -->
                    <div>
                        <div class="flex items-center mb-2">
                            <label class="block text-sm font-medium text-gray-700">Tingkat Proses Kognitif <span class="text-red-500">*</span></label>
                            <div class="relative group ml-2 flex items-center">
                                <i class="fas fa-question-circle text-gray-400 hover:text-emerald-600 cursor-help transition-colors"></i>
                                <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 hidden group-hover:block w-72 p-3 bg-gray-800 text-white text-xs rounded-lg shadow-xl z-50 transition-opacity">
                                    <p class="font-semibold mb-1 border-b border-gray-600 pb-1">Teori Dasar: Berbasis Taksonomi Bloom Revisi, yang mengklasifikasikan kerumitan proses berpikir. Di era AI, dikenal pula "Taksonomi Bloom Terbalik" di mana mahasiswa justru menggunakan AI untuk 'mencipta' di awal, lalu harus 'mengevaluasi' dan 'menganalisis' hasil AI tersebut.</p>
                                    <ul class="list-disc pl-4 space-y-1">
                                        <li><strong>Mengingat (Remember):</strong> Mahasiswa hanya diminta mengenali, memanggil, atau mengulang informasi, fakta, dan definisi dasar.</li>
                                        <li><strong>Memahami (Understand):</strong> Mahasiswa diminta membangun makna, menginterpretasikan, mengklasifikasikan, atau merangkum informasi.</li>
                                        <li><strong>Mengaplikasikan (Apply):</strong> Mahasiswa diminta menggunakan materi atau prosedur yang telah dipelajari ke dalam situasi nyata (misal: menggunakan rumus, melakukan wawancara).</li>
                                        <li><strong>Menganalisis (Analyze):</strong> Mahasiswa diminta memecah informasi ke dalam bagian-bagian komponennya dan menentukan bagaimana bagian-bagian tersebut saling berhubungan.</li>
                                        <li><strong>Mengevaluasi (Evaluate):</strong> Mahasiswa diminta membuat penilaian berdasarkan kriteria atau standar tertentu (melakukan kritik atau rekomendasi). (Sangat penting untuk mengkritisi output AI).</li>
                                        <li><strong>Mencipta (Create):</strong> Mahasiswa diminta menyatukan elemen-elemen untuk membentuk suatu kesatuan baru yang koheren, orisinal, atau fungsional.</li>
                                    </ul>
                                    <div class="absolute top-full left-1/2 -translate-x-1/2 border-4 border-transparent border-t-gray-800"></div>
                                </div>
                            </div>
                        </div>
                        <select id="tingkat_proses_kognitif" name="kriteria_tugas[tingkat_proses_kognitif]" class="w-full bg-white border border-gray-300 text-gray-700 py-2 px-3 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-600 focus:border-transparent kognitif-select" required>
                            <option value="">-- Pilih Tingkat Proses Kognitif --</option>
                            @foreach($kriteriaOptions['tingkat_proses_kognitif'] as $option)
                                <option value="{{ $option }}" {{ old('kriteria_tugas.tingkat_proses_kognitif') == $option ? 'selected' : '' }}>
                                    @if($option == 'Mengingat') Mengingat (Remember)
                                    @elseif($option == 'Memahami') Memahami (Understand)
                                    @elseif($option == 'Mengaplikasikan') Mengaplikasikan (Apply)
                                    @elseif($option == 'Menganalisis') Menganalisis (Analyze)
                                    @elseif($option == 'Mengevaluasi') Mengevaluasi (Evaluate)
                                    @elseif($option == 'Mencipta') Mencipta (Create)
                                    @else {{ $option }}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Dimensi Pengetahuan -->
                    <div>
                        <div class="flex items-center mb-2">
                            <label class="block text-sm font-medium text-gray-700">Jenis Target Pengetahuan <span class="text-red-500">*</span></label>
                            <div class="relative group ml-2 flex items-center">
                                <i class="fas fa-question-circle text-gray-400 hover:text-emerald-600 cursor-help transition-colors"></i>
                                <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 hidden group-hover:block w-72 p-3 bg-gray-800 text-white text-xs rounded-lg shadow-xl z-50 transition-opacity">
                                    <p class="font-semibold mb-1 border-b border-gray-600 pb-1">Teori Dasar: Merupakan klasifikasi jenis pengetahuan yang ingin diukur dari mahasiswa, masih berdasarkan kerangka Anderson & Krathwohl. Poin ini penting karena AI sangat pintar menguasai fakta dan konsep, namun tidak memiliki metakognisi layaknya manusia.</p>
                                    <ul class="list-disc pl-4 space-y-1">
                                        <li><strong>Pengetahuan Faktual:</strong> Mengukur penguasaan elemen-elemen dasar (fakta, detail, terminologi spesifik) yang harus diketahui mahasiswa dalam suatu disiplin ilmu.</li>
                                        <li><strong>Pengetahuan Konseptual:</strong> Mengukur pemahaman tentang teori, prinsip, model, dan bagaimana struktur tersebut saling berhubungan.</li>
                                        <li><strong>Pengetahuan Prosedural:</strong> Mengukur penguasaan cara melakukan sesuatu, teknik, algoritma, atau metodologi spesifik.</li>
                                        <li><strong>Pengetahuan Metakognitif:</strong> Mengukur kesadaran mahasiswa atas pemikirannya sendiri, refleksi strategis, dan kemampuan mengevaluasi keputusannya (seperti sadar kapan harus percaya AI dan kapan harus kritis terhadap AI).</li>
                                    </ul>
                                    <div class="absolute top-full left-1/2 -translate-x-1/2 border-4 border-transparent border-t-gray-800"></div>
                                </div>
                            </div>
                        </div>
                        <select id="dimensi_pengetahuan" name="kriteria_tugas[dimensi_pengetahuan]" class="w-full bg-white border border-gray-300 text-gray-700 py-2 px-3 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-600 focus:border-transparent" required>
                            <option value="">-- Pilih Jenis Target Pengetahuan --</option>
                            @foreach($kriteriaOptions['dimensi_pengetahuan'] as $option)
                                <option value="{{ $option }}" {{ old('kriteria_tugas.dimensi_pengetahuan') == $option ? 'selected' : '' }}>
                                    {{ $option }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Struktur Kompleksitas Respons -->
                    <div>
                        <div class="flex items-center mb-2">
                            <label class="block text-sm font-medium text-gray-700">Kompleksitas Jawaban <span class="text-red-500">*</span></label>
                            <div class="relative group ml-2 flex items-center">
                                <i class="fas fa-question-circle text-gray-400 hover:text-emerald-600 cursor-help transition-colors"></i>
                                <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 hidden group-hover:block w-72 p-3 bg-gray-800 text-white text-xs rounded-lg shadow-xl z-50 transition-opacity">
                                    <p class="font-semibold mb-1 border-b border-gray-600 pb-1">Teori Dasar: Taksonomi SOLO (Structure of the Observed Learning Outcome) mengukur seberapa dalam dan seberapa kompleks susunan argumen atau jawaban mahasiswa. AI saat ini mampu merangkai hubungan, tapi kesulitan menggeneralisasi ide ke ranah yang sama sekali baru (Extended Abstract).</p>
                                    <ul class="list-disc pl-4 space-y-1">
                                        <li><strong>Prastruktural (Prestructural):</strong> Respons mahasiswa sangat dasar.</li>
                                        <li><strong>Unistruktural (Unistructural):</strong> Respons mahasiswa hanya menangkap satu aspek dari konsep, sangat terbatas, dan tidak melihat gambaran besarnya.</li>
                                        <li><strong>Multistruktural (Multistructural):</strong> Respons mahasiswa menyebutkan beberapa komponen atau aspek independen, tetapi belum mampu menghubungkannya menjadi satu kesatuan yang koheren.</li>
                                        <li><strong>Relasional (Relational):</strong> Respons mahasiswa berhasil mengintegrasikan banyak elemen menjadi sebuah pola yang terstruktur dan bermakna (menunjukkan sebab-akibat atau relasi antar variabel).</li>
                                        <li><strong>Abstrak Diperluas (Extended Abstract):</strong> Respons mahasiswa mampu melampaui informasi yang diberikan, mentransfer pemahaman ke domain masalah yang sama sekali baru, menyusun teori baru, atau menciptakan solusi yang belum pernah ada sebelumnya.</li>
                                    </ul>
                                    <div class="absolute top-full left-1/2 -translate-x-1/2 border-4 border-transparent border-t-gray-800"></div>
                                </div>
                            </div>
                        </div>
                        <select id="struktur_kompleksitas_respons" name="kriteria_tugas[struktur_kompleksitas_respons]" class="w-full bg-white border border-gray-300 text-gray-700 py-2 px-3 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-600 focus:border-transparent" required>
                            <option value="">-- Pilih Kompleksitas Jawaban --</option>
                            @foreach($kriteriaOptions['struktur_kompleksitas_respons'] as $option)
                                <option value="{{ $option }}" {{ old('kriteria_tugas.struktur_kompleksitas_respons') == $option ? 'selected' : '' }}>
                                    @if($option == 'Prastruktural') Prastruktural (Prestructural)
                                    @elseif($option == 'Unistruktural') Unistruktural (Unistructural)
                                    @elseif($option == 'Multistruktural') Multistruktural (Multistructural)
                                    @elseif($option == 'Relasional') Relasional (Relational)
                                    @elseif($option == 'Abstrak Diperluas') Abstrak Diperluas (Extended Abstract)
                                    @else {{ $option }}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Konteks & Skenario Tugas -->
                    <div>
                        <div class="flex items-center mb-2">
                            <label class="block text-sm font-medium text-gray-700">Konteks & Skenario Tugas <span class="text-red-500">*</span></label>
                            <div class="relative group ml-2 flex items-center">
                                <i class="fas fa-question-circle text-gray-400 hover:text-emerald-600 cursor-help transition-colors"></i>
                                <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 hidden group-hover:block w-72 p-3 bg-gray-800 text-white text-xs rounded-lg shadow-xl z-50 transition-opacity">
                                    <p class="font-semibold mb-1 border-b border-gray-600 pb-1">Teori Dasar: Mengukur seberapa dekat relevansi tugas dengan kondisi profesional di dunia nyata. Ini adalah penangkal AI yang paling kuat karena AI kesulitan menghadapi konteks nyata yang dinamis, beretika, dan spesifik-lokal.</p>
                                    <ul class="list-disc pl-4 space-y-1">
                                        <li><strong>Dekontekstualisasi / Tradisional:</strong> Tugas yang kaku, sempit, dan terlepas dari praktik dunia nyata (misal: esai teoretis umum). (Sangat mudah diotomatisasi penuh oleh AI).</li>
                                        <li><strong>Simulasi / Terapan:</strong> Tugas yang meminta mahasiswa menyimulasikan proses, aktivitas, atau standar kinerja dari dunia kerja ke dalam skenario kelas.</li>
                                        <li><strong>Otentik / Dunia Nyata:</strong> Tugas yang sepenuhnya merefleksikan realitas kehidupan profesional, melibatkan dinamika global, multidisipliner, interaksi dengan manusia asli (klien/masyarakat), dan etika.</li>
                                    </ul>
                                    <div class="absolute top-full left-1/2 -translate-x-1/2 border-4 border-transparent border-t-gray-800"></div>
                                </div>
                            </div>
                        </div>
                        <select id="tingkat_keaslian_konteks" name="kriteria_tugas[tingkat_keaslian_konteks]" class="w-full bg-white border border-gray-300 text-gray-700 py-2 px-3 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-600 focus:border-transparent" required>
                            <option value="">-- Pilih Konteks & Skenario --</option>
                            @foreach($kriteriaOptions['tingkat_keaslian_konteks'] as $option)
                                <option value="{{ $option }}" {{ old('kriteria_tugas.tingkat_keaslian_konteks') == $option ? 'selected' : '' }}>
                                    {{ $option }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Fokus Penilaian -->
                    <div>
                        <div class="flex items-center mb-2">
                            <label class="block text-sm font-medium text-gray-700">Fokus Penilaian <span class="text-red-500">*</span></label>
                            <div class="relative group ml-2 flex items-center">
                                <i class="fas fa-question-circle text-gray-400 hover:text-emerald-600 cursor-help transition-colors"></i>
                                <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 hidden group-hover:block w-72 p-3 bg-gray-800 text-white text-xs rounded-lg shadow-xl z-50 transition-opacity">
                                    <p class="font-semibold mb-1 border-b border-gray-600 pb-1">Teori Dasar: Pergeseran paradigma evaluasi karena AI. Dosen tidak bisa lagi hanya menilai "hasil akhirnya saja" (karena hasil akhir bisa diketik oleh ChatGPT), melainkan harus menilai proses belajarnya dan mengujinya secara langsung.</p>
                                    <ul class="list-disc pl-4 space-y-1">
                                        <li><strong>Asesmen Produk:</strong> Dosen hanya menilai berdasarkan produk/hasil akhir yang dikumpulkan mahasiswa (esai, laporan, desain, program akhir) tanpa melihat bagaimana ia dibuat.</li>
                                        <li><strong>Asesmen Proses:</strong> Dosen mengevaluasi perjalanan pembuatan tugas tersebut (menilai draf, log prompt AI yang dipakai mahasiswa, iterasi desain, revisi, dan jurnal reflektif).</li>
                                        <li><strong>Asesmen Dialogis:</strong> Dosen mengevaluasi kemampuan bernalar mahasiswa secara real-time dan interaktif (melalui pembelaan lisan, presentasi tanya jawab, atau viva voces) untuk memastikan orisinalitas pemikiran mahasiswa.</li>
                                    </ul>
                                    <div class="absolute top-full left-1/2 -translate-x-1/2 border-4 border-transparent border-t-gray-800"></div>
                                </div>
                            </div>
                        </div>
                        <select id="fokus_evaluasi" name="kriteria_tugas[fokus_evaluasi]" class="w-full bg-white border border-gray-300 text-gray-700 py-2 px-3 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-600 focus:border-transparent" required>
                            <option value="">-- Pilih Fokus Penilaian --</option>
                            @foreach($kriteriaOptions['fokus_evaluasi'] as $option)
                                <option value="{{ $option }}" {{ old('kriteria_tugas.fokus_evaluasi') == $option ? 'selected' : '' }}>
                                    {{ $option }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="bg-emerald-50 border-l-4 border-emerald-600 p-4 mt-6">
                    <p class="text-sm text-emerald-700"><strong>Penting:</strong> Setelah Anda menyimpan, Mesin Inferensi akan secara otomatis mengevaluasi kombinasi kriteria di atas and menetapkan Tingkat AI Score yang diizinkan untuk tugas ini.</p>
                </div>
            </div>
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50 flex items-center justify-end gap-3">
                <button type="submit" name="action" value="draft" class="px-5 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-600">
                    Simpan Draft
                </button>
                <button type="submit" name="action" value="publish" class="px-5 py-2 border border-transparent rounded-md shadow-sm text-sm font-bold text-white bg-emerald-700 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    <i class="fas fa-check-circle mr-2"></i> Simpan & Klasifikasi AI Score
                </button>
            </div>
        </form>
    </div>
@endsection


