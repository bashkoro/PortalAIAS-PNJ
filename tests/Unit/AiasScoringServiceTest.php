<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\AiasScoringService;

class AiasScoringServiceTest extends TestCase
{
    private AiasScoringService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new AiasScoringService();
    }

    public function test_controlled_environment_returns_level_1_by_default(): void
    {
        $inputs = [
            'lingkungan' => 'Terkendali Penuh / Terawasi',
            'kognitif' => 'Mengingat (Remembering)',
            'pengetahuan' => 'Faktual',
            'kompleksitas' => 'Prastruktural',
            'konteks' => 'Otentik',
            'evaluasi' => 'Asesmen Produk',
        ];

        $level = $this->service->calculateLevel($inputs);

        $this->assertEquals(1, $level);
    }

    public function test_controlled_environment_returns_level_2_if_kognitif_is_mencipta(): void
    {
        $inputs = [
            'lingkungan' => 'Terkendali Penuh / Terawasi',
            'kognitif' => 'Mencipta (Creating)',
            'pengetahuan' => 'Faktual',
            'kompleksitas' => 'Prastruktural',
            'konteks' => 'Otentik',
            'evaluasi' => 'Asesmen Produk',
        ];

        $level = $this->service->calculateLevel($inputs);

        $this->assertEquals(2, $level);
    }

    public function test_controlled_environment_returns_level_2_if_pengetahuan_is_metakognitif(): void
    {
        $inputs = [
            'lingkungan' => 'Terkendali Penuh / Terawasi',
            'kognitif' => 'Mengingat (Remembering)',
            'pengetahuan' => 'Pengetahuan Metakognitif',
            'kompleksitas' => 'Prastruktural',
            'konteks' => 'Otentik',
            'evaluasi' => 'Asesmen Produk',
        ];

        $level = $this->service->calculateLevel($inputs);

        $this->assertEquals(2, $level);
    }

    public function test_open_environment_returns_level_5_for_max_score_16(): void
    {
        // Max score: 5 (Mengingat) + 3 (Faktual) + 4 (Prastruktural) + 2 (Dekontekstualisasi) + 2 (Asesmen Produk) = 16
        $inputs = [
            'lingkungan' => 'Bebas / Terbuka',
            'kognitif' => 'Mengingat (Remembering)',
            'pengetahuan' => 'Faktual',
            'kompleksitas' => 'Prastruktural',
            'konteks' => 'Dekontekstualisasi',
            'evaluasi' => 'Asesmen Produk',
        ];

        $level = $this->service->calculateLevel($inputs);

        $this->assertEquals(5, $level);
    }

    public function test_open_environment_returns_level_2_for_min_score_0(): void
    {
        // Min score: 0 (Mencipta) + 0 (Metakognitif) + 0 (Abstrak Diperluas) + 0 (Otentik) + 0 (Asesmen Dialogis) = 0
        $inputs = [
            'lingkungan' => 'Bebas / Terbuka',
            'kognitif' => 'Mencipta (Creating)',
            'pengetahuan' => 'Metakognitif',
            'kompleksitas' => 'Abstrak Diperluas',
            'konteks' => 'Otentik',
            'evaluasi' => 'Asesmen Dialogis',
        ];

        $level = $this->service->calculateLevel($inputs);

        $this->assertEquals(2, $level);
    }

    public function test_open_environment_returns_level_5_for_score_exactly_12(): void
    {
        // Score: 3 (Mengaplikasikan) + 2 (Konseptual) + 3 (Unistruktural) + 2 (Dekontekstualisasi) + 2 (Asesmen Produk) = 12
        $inputs = [
            'lingkungan' => 'Bebas / Terbuka',
            'kognitif' => 'Mengaplikasikan (Applying)',
            'pengetahuan' => 'Konseptual',
            'kompleksitas' => 'Unistruktural',
            'konteks' => 'Dekontekstualisasi',
            'evaluasi' => 'Asesmen Produk',
        ];

        $level = $this->service->calculateLevel($inputs);

        $this->assertEquals(5, $level);
    }

    public function test_open_environment_returns_level_4_for_score_exactly_11(): void
    {
        // Score: 2 (Menganalisis) + 2 (Konseptual) + 3 (Unistruktural) + 2 (Dekontekstualisasi) + 2 (Asesmen Produk) = 11
        $inputs = [
            'lingkungan' => 'Bebas / Terbuka',
            'kognitif' => 'Menganalisis (Analyzing)',
            'pengetahuan' => 'Konseptual',
            'kompleksitas' => 'Unistruktural',
            'konteks' => 'Dekontekstualisasi',
            'evaluasi' => 'Asesmen Produk',
        ];

        $level = $this->service->calculateLevel($inputs);

        $this->assertEquals(4, $level);
    }

    public function test_open_environment_returns_level_4_for_score_exactly_8(): void
    {
        // Score: 2 (Menganalisis) + 1 (Prosedural) + 2 (Multistruktural) + 1 (Simulasi) + 2 (Asesmen Produk) = 8
        $inputs = [
            'lingkungan' => 'Bebas / Terbuka',
            'kognitif' => 'Menganalisis (Analyzing)',
            'pengetahuan' => 'Prosedural',
            'kompleksitas' => 'Multistruktural',
            'konteks' => 'Simulasi',
            'evaluasi' => 'Asesmen Produk',
        ];

        $level = $this->service->calculateLevel($inputs);

        $this->assertEquals(4, $level);
    }

    public function test_open_environment_returns_level_3_for_score_exactly_7(): void
    {
        // Score: 1 (Mengevaluasi) + 1 (Prosedural) + 2 (Multistruktural) + 1 (Simulasi) + 2 (Asesmen Produk) = 7
        $inputs = [
            'lingkungan' => 'Bebas / Terbuka',
            'kognitif' => 'Mengevaluasi (Evaluating)',
            'pengetahuan' => 'Prosedural',
            'kompleksitas' => 'Multistruktural',
            'konteks' => 'Simulasi',
            'evaluasi' => 'Asesmen Produk',
        ];

        $level = $this->service->calculateLevel($inputs);

        $this->assertEquals(3, $level);
    }

    public function test_open_environment_returns_level_3_for_score_exactly_4(): void
    {
        // Score: 1 (Mengevaluasi) + 1 (Prosedural) + 1 (Relasional) + 1 (Simulasi) + 0 (Asesmen Dialogis) = 4
        $inputs = [
            'lingkungan' => 'Bebas / Terbuka',
            'kognitif' => 'Mengevaluasi (Evaluating)',
            'pengetahuan' => 'Prosedural',
            'kompleksitas' => 'Relasional',
            'konteks' => 'Simulasi',
            'evaluasi' => 'Asesmen Dialogis',
        ];

        $level = $this->service->calculateLevel($inputs);

        $this->assertEquals(3, $level);
    }

    public function test_open_environment_returns_level_2_for_score_exactly_3(): void
    {
        // Score: 1 (Mengevaluasi) + 0 (Metakognitif) + 1 (Relasional) + 1 (Simulasi) + 0 (Asesmen Dialogis) = 3
        $inputs = [
            'lingkungan' => 'Bebas / Terbuka',
            'kognitif' => 'Mengevaluasi (Evaluating)',
            'pengetahuan' => 'Metakognitif',
            'kompleksitas' => 'Relasional',
            'konteks' => 'Simulasi',
            'evaluasi' => 'Asesmen Dialogis',
        ];

        $level = $this->service->calculateLevel($inputs);

        $this->assertEquals(2, $level);
    }
}
