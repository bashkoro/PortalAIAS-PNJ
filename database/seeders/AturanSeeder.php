<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AturanSeeder extends Seeder
{
    public function run(): void
    {
        // Use CASCADE for PostgreSQL truncation
        DB::table('kondisi_aturan')->truncate();
        DB::statement('TRUNCATE TABLE aturan CASCADE;');

        $lingkungan = ['Terbuka / Tanpa Pengawasan', 'Terkendali Penuh / Terawasi'];
        // Use the exact strings expected by the UI
        $kognitif = ['Mengingat (Remembering)', 'Memahami (Understanding)', 'Mengaplikasikan (Applying)', 'Menganalisis (Analyzing)', 'Mengevaluasi (Evaluating)', 'Mencipta (Creating)'];
        $pengetahuan = ['Pengetahuan Faktual', 'Pengetahuan Konseptual', 'Pengetahuan Prosedural', 'Pengetahuan Metakognitif'];
        $kompleksitas = ['Prastruktural', 'Unistruktural', 'Multistruktural', 'Relasional', 'Abstrak Diperluas (Extended Abstract)'];
        $konteks = ['Dekontekstualisasi / Tradisional', 'Simulasi / Terapan', 'Otentik / Dunia Nyata'];
        $evaluasi = ['Asesmen Produk', 'Asesmen Proses', 'Asesmen Dialogis'];

        $aturanInserts = [];
        $kondisiInserts = [];
        $ruleCount = 1;

        // Weights for vulnerability score in open environments
        $vulnWeights = [
            'kognitif' => [
                'Mengingat (Remembering)' => 5,
                'Memahami (Understanding)' => 4,
                'Mengaplikasikan (Applying)' => 3,
                'Menganalisis (Analyzing)' => 2,
                'Mengevaluasi (Evaluating)' => 1,
                'Mencipta (Creating)' => 0,
            ],
            'pengetahuan' => [
                'Pengetahuan Faktual' => 3,
                'Pengetahuan Konseptual' => 2,
                'Pengetahuan Prosedural' => 1,
                'Pengetahuan Metakognitif' => 0,
            ],
            'kompleksitas' => [
                'Prastruktural' => 4,
                'Unistruktural' => 3,
                'Multistruktural' => 2,
                'Relasional' => 1,
                'Abstrak Diperluas (Extended Abstract)' => 0,
            ],
            'konteks' => [
                'Dekontekstualisasi / Tradisional' => 2,
                'Simulasi / Terapan' => 1,
                'Otentik / Dunia Nyata' => 0,
            ],
            'evaluasi' => [
                'Asesmen Produk' => 2,
                'Asesmen Proses' => 1,
                'Asesmen Dialogis' => 0,
            ]
        ];

        DB::beginTransaction();

        try {
            foreach ($lingkungan as $l) {
                foreach ($kognitif as $kog) {
                    foreach ($pengetahuan as $pen) {
                        foreach ($kompleksitas as $kom) {
                            foreach ($konteks as $kon) {
                                foreach ($evaluasi as $ev) {
                                    
                                    // Logic Scoring Algorithm
                                    $level = 1;
                                    
                                    if ($l === 'Terkendali Penuh / Terawasi') {
                                        // Controlled env: mostly Level 1, maybe Level 2 if creating/metacognitive
                                        if ($kog === 'Mencipta (Creating)' || $pen === 'Pengetahuan Metakognitif') {
                                            $level = 2;
                                        } else {
                                            $level = 1;
                                        }
                                    } else {
                                        // Open env: vulnerable to AI
                                        $score = $vulnWeights['kognitif'][$kog] 
                                               + $vulnWeights['pengetahuan'][$pen] 
                                               + $vulnWeights['kompleksitas'][$kom] 
                                               + $vulnWeights['konteks'][$kon] 
                                               + $vulnWeights['evaluasi'][$ev];
                                        
                                        // Max score is 5+3+4+2+2 = 16
                                        if ($score >= 12) {
                                            $level = 5; // Very vulnerable, must assume full AI use
                                        } elseif ($score >= 8) {
                                            $level = 4;
                                        } elseif ($score >= 4) {
                                            $level = 3;
                                        } else {
                                            $level = 2; // Highly secure format (authentic, process-driven, creating)
                                        }
                                    }

                                    $aturanInserts[] = [
                                        'id' => $ruleCount,
                                        'tingkat_aias_id' => $level,
                                        'is_active' => true,
                                    ];

                                    $kondisiInserts[] = ['aturan_id' => $ruleCount, 'nama_parameter' => 'lingkungan_pengerjaan', 'operator' => '=', 'target_value' => $l];
                                    $kondisiInserts[] = ['aturan_id' => $ruleCount, 'nama_parameter' => 'tingkat_proses_kognitif', 'operator' => '=', 'target_value' => $kog];
                                    $kondisiInserts[] = ['aturan_id' => $ruleCount, 'nama_parameter' => 'dimensi_pengetahuan', 'operator' => '=', 'target_value' => $pen];
                                    $kondisiInserts[] = ['aturan_id' => $ruleCount, 'nama_parameter' => 'struktur_kompleksitas_respons', 'operator' => '=', 'target_value' => $kom];
                                    $kondisiInserts[] = ['aturan_id' => $ruleCount, 'nama_parameter' => 'tingkat_keaslian_konteks', 'operator' => '=', 'target_value' => $kon];
                                    $kondisiInserts[] = ['aturan_id' => $ruleCount, 'nama_parameter' => 'fokus_evaluasi', 'operator' => '=', 'target_value' => $ev];

                                    $ruleCount++;

                                    // Chunk inserts to prevent memory issues
                                    if (count($aturanInserts) >= 500) {
                                        DB::table('aturan')->insert($aturanInserts);
                                        DB::table('kondisi_aturan')->insert($kondisiInserts);
                                        $aturanInserts = [];
                                        $kondisiInserts = [];
                                    }
                                }
                            }
                        }
                    }
                }
            }

            // Insert remaining
            if (count($aturanInserts) > 0) {
                DB::table('aturan')->insert($aturanInserts);
                DB::table('kondisi_aturan')->insert($kondisiInserts);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
