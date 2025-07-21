<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Pix;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PixGenerationTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_logged_in_user_can_generate_a_pix()
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->postJson('/pix');
        $response->assertStatus(201);
        $response->assertJsonStructure([
            'token',
            'expires_at',
            'status',
            'link',
        ]);

        $this->assertDatabaseHas('pix', [
            'user_id' => $user->id,
            'status' => 'generated',
        ]);

        $pix = Pix::first();

        $this->assertTrue(Str::isUuid($pix->token));
        $this->assertTrue(Carbon::parse($pix->expires_at)->greaterThan(now()));
    }

    public function test_a_guest_cannot_generate_a_pix()
    {
        $response = $this->postJson('/pix');

        $response->assertStatus(401);

        $this->assertDatabaseCount('pix', 0);
    }
}
