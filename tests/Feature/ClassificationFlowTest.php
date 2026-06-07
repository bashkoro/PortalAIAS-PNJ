<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\AturanSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClassificationFlowTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Seed the 2,160 rules needed for the Forward Chaining assessment.
        $this->seed(AturanSeeder::class);
    }

    public function test_authenticated_user_can_submit_assessment(): void
    {
        $user = User::factory()->create();

        $payload = [
            'lingkungan' => 'Terkendali Penuh / Terawasi',
            'kognitif' => 'Mengingat (Remembering)',
            'pengetahuan' => 'Faktual',
            'kompleksitas' => 'Prastruktural',
            'konteks' => 'Otentik',
            'evaluasi' => 'Asesmen Produk',
        ];

        // Replace '/assessment/classify' with your actual classification route
        $response = $this->actingAs($user)->post('/assessment/classify', $payload);

        // Assert it redirects back or to a result page (adjust to 200 if it's an API returning JSON)
        $response->assertStatus(302);

        // Adjust 'assessment_histories' to your actual table name (e.g., 'riwayat_prompts')
        $this->assertDatabaseHas('assessment_histories', [
            'user_id' => $user->id,
            'lingkungan' => 'Terkendali Penuh / Terawasi',
        ]);
    }

    public function test_validation_errors_when_parameters_are_missing(): void
    {
        $user = User::factory()->create();

        // Submitting an incomplete payload
        $payload = [
            'lingkungan' => 'Terkendali Penuh / Terawasi',
            // Missing all other required parameters
        ];

        $response = $this->actingAs($user)->post('/assessment/classify', $payload);

        // Assert the session contains validation errors for the missing fields
        $response->assertSessionHasErrors([
            'kognitif',
            'pengetahuan',
            'kompleksitas',
            'konteks',
            'evaluasi'
        ]);

        // Adjust 'assessment_histories' to your actual table name
        $this->assertDatabaseCount('assessment_histories', 0);
    }
}
