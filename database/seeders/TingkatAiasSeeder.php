<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TingkatAiasSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tingkat_aias')->insert([
            [
                'nama_tingkat' => 'Level 1',
                'deskripsi' => 'No AI: Mahasiswa menyelesaikan tugas sepenuhnya tanpa bantuan AI dalam lingkungan yang terkendali untuk memastikan validitas hasil belajar murni (Perkins et al., 2025).',
            ],
            [
                'nama_tingkat' => 'Level 2',
                'deskripsi' => 'AI Planning: AI digunakan terbatas pada tahap pra-tugas seperti brainstorming dan penelitian awal, namun hasil akhir tetap merupakan karya manusia sepenuhnya (Perkins et al., 2025).',
            ],
            [
                'nama_tingkat' => 'Level 3',
                'deskripsi' => 'AI Collaboration: Mahasiswa diizinkan berkolaborasi dengan AI dalam penyusunan draf, penyuntingan, dan perbaikan teks, dengan kewajiban melakukan evaluasi kritis terhadap setiap output yang dihasilkan mesin (Perkins et al., 2025).',
            ],
            [
                'nama_tingkat' => 'Level 4',
                'deskripsi' => 'Full AI: AI digunakan secara strategis dan ekstensif untuk mencapai tujuan asesmen, di mana fokus penilaian beralih pada kemampuan mahasiswa dalam mengarahkan teknologi untuk memecahkan masalah kompleks (Perkins et al., 2025).',
            ],
            [
                'nama_tingkat' => 'Level 5',
                'deskripsi' => 'AI Exploration: Mahasiswa dan dosen melakukan ko-desain asesmen untuk mengeksplorasi aplikasi AI yang unik dan inovatif dalam bidang studi tertentu, mendorong batas-batas kreativitas akademik (Perkins et al., 2025).',
            ],
        ]);
    }
}
