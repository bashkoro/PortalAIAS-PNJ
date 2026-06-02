# Portal Asesmen AI - AI Score PNJ

Sistem Pakar klasifikasi integritas akademik berbasis kerangka kerja **AI Assessment Scale (AIAS)** untuk mengotomatiskan penentuan batas penggunaan Kecerdasan Buatan (AI) pada tugas perkuliahan secara transparan dan adil.

## Deskripsi Proyek
AI Score PNJ dirancang untuk membantu dosen dan mahasiswa di lingkungan Politeknik Negeri Jakarta (PNJ) dalam menavigasi penggunaan alat AI (seperti ChatGPT) dalam kegiatan akademik. Sistem ini menggunakan mesin inferensi **Forward Chaining** untuk mengevaluasi kriteria tugas berdasarkan literatur pendidikan (Taksonomi Bloom & Taksonomi SOLO) dan menghasilkan tingkat klasifikasi AIAS yang diizinkan (Level 1 - Level 5).

## Fitur Utama
- **Sistem Pakar Forward Chaining**: Mesin klasifikasi otomatis berbasis aturan (*Rule-Based*) untuk menentukan level AIAS.
- **Portal Multi-User**:
  - **Dosen**: Membuat penugasan dengan parameter kognitif dan teknis yang detail, serta memantau deklarasi mahasiswa.
  - **Mahasiswa**: Mengisi deklarasi mandiri penggunaan AI sesuai dengan batasan yang telah ditetapkan dosen.
  - **Admin**: Mengelola basis pengetahuan (*Knowledge Base*), pengguna, dan aturan sistem.
- **Karakteristik Tugas Berbasis Literatur**: Parameter pengerjaan yang mencakup Lingkungan Pengerjaan, Proses Kognitif, Dimensi Pengetahuan, Struktur Respons, Keaslian Konteks, dan Fokus Evaluasi.
- **UI Modern & Responsif**: Dibangun dengan Tailwind CSS, menggunakan komponen *sticky* untuk navigasi, dan *tooltip* edukatif untuk setiap opsi kriteria.

## Teknologi Utama
- **Framework**: [Laravel 11](https://laravel.com)
- **Styling**: [Tailwind CSS](https://tailwindcss.com)
- **Database**: PostgreSQL (Support untuk seeder kombinasi masif ~2.160 aturan)
- **Frontend Components**: TomSelect (Searchable dropdowns), FontAwesome Icons.

## Instalasi

1. Clone repositori:
   ```bash
   git clone https://github.com/username/AI_Score.git
   ```
2. Instal dependensi PHP:
   ```bash
   composer install
   ```
3. Instal dependensi Node.js:
   ```bash
   npm install && npm run build
   ```
4. Konfigurasi Environment:
   Salin `.env.example` menjadi `.env` dan sesuaikan pengaturan database Anda.
5. Generate App Key & Migrasi Database:
   ```bash
   php artisan key:generate
   ```
6. Jalankan Migrasi & Seeder (Penting untuk Knowledge Base):
   ```bash
   php artisan migrate --seed
   ```
   *Catatan: Aturan klasifikasi otomatis dihasilkan melalui `AturanSeeder`.*

## Struktur Penting
- `app/Http/Controllers/TaskController.php`: Logika utama pembuatan tugas dan validasi kriteria.
- `app/Models/Tugas.php`: Implementasi mesin inferensi *Forward Chaining* di metode `calculateAIScore`.
- `database/seeders/AturanSeeder.php`: Algoritma pembangkit seluruh kombinasi aturan klasifikasi.
- `resources/views/dosen/create.blade.php`: Antarmuka formulir cerdas pembuatan tugas.

---
© 2024 Portal Asesmen AI PNJ. Dikembangkan untuk kepentingan penelitian skripsi integritas akademik di era AI.
