<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class DashboardHistoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_their_own_classification_history(): void
    {
        $user = User::factory()->create();

        // Create some dummy assessment history for this user.
        // Adjust the table name 'assessment_histories' (e.g., to 'riwayat_prompts') and columns to match your schema.
        DB::table('assessment_histories')->insert([
            'user_id' => $user->id,
            'lingkungan' => 'Terkendali Penuh / Terawasi',
            'kognitif' => 'Mengingat (Remembering)',
            'pengetahuan' => 'Faktual',
            'kompleksitas' => 'Prastruktural',
            'konteks' => 'Otentik',
            'evaluasi' => 'Asesmen Produk',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Replace '/dashboard' with your actual route that displays the history
        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);
        
        // Assert the view contains the assessment data.
        $response->assertSee('Terkendali Penuh / Terawasi');
        $response->assertSee('Mengingat (Remembering)');
    }

    public function test_user_cannot_view_other_users_history(): void
    {
        $userA = User::factory()->create();
        $userB = User::factory()->create();

        // Give User A an assessment history.
        // Adjust table name and columns accordingly.
        DB::table('assessment_histories')->insert([
            'user_id' => $userA->id,
            'lingkungan' => 'Bebas / Terbuka',
            'kognitif' => 'Mencipta (Creating)',
            'pengetahuan' => 'Metakognitif',
            'kompleksitas' => 'Abstrak Diperluas',
            'konteks' => 'Otentik',
            'evaluasi' => 'Asesmen Dialogis',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Act as User B and visit the dashboard
        $response = $this->actingAs($userB)->get('/dashboard');

        $response->assertStatus(200);

        // Assert that User A's history is NOT visible to User B.
        $response->assertDontSee('Bebas / Terbuka');
        $response->assertDontSee('Mencipta (Creating)');
    }
}
