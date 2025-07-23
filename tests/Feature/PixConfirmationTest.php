<?php

namespace Tests\Feature;

use App\Models\Pix;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PixConfirmationTest extends TestCase
{
    use RefreshDatabase;

    public function test_pix_becomes_paid_when_accessed_before_expiration()
    {
        $user = User::factory()->create();

        $pix = Pix::create([
            'user_id' => $user->id,
            'token' => 'valid-token',
            'status' => 'generated',
            'expires_at' => Carbon::now()->addMinutes(10),
        ]);

        $response = $this->get('/pix/' . $pix->token);

        $response->assertStatus(200);
        $this->assertDatabaseHas('pix', [
            'id' => $pix->id,
            'status' => 'paid',
        ]);

        $response->assertSee('Status: Pago');
    }

    public function test_pix_becomes_expired_when_accessed_after_expiration()
    {
        $user = User::factory()->create();

        $pix = Pix::create([
            'user_id' => $user->id,
            'token' => 'expired-token',
            'status' => 'generated',
            'expires_at' => Carbon::now()->subMinutes(5),
        ]);

        $response = $this->get('/pix/' . $pix->token);

        $response->assertStatus(200);
        $this->assertDatabaseHas('pix', [
            'id' => $pix->id,
            'status' => 'expired',
        ]);

        $response->assertSee('Status: Expirado');
    }

    public function test_accessing_non_existent_pix_token_returns_404()
    {
        $response = $this->get('/pix/invalid-token');

        $response->assertStatus(404);
    }
}
