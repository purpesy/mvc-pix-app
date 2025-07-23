<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Pix;
use App\Models\User;
use Carbon\Carbon;

class ExpirePixCommandTest extends TestCase
{
    use RefreshDatabase;

    public function test_expirepix_command_expira_pix_vencidos()
    {
        $user = User::factory()->create();
        Pix::factory()->count(2)->for($user)->create([
            'status' => 'generated',
            'expires_at' => Carbon::now()->addHour(),
        ]);
        Pix::factory()->count(3)->for($user)->create([
            'status' => 'generated',
            'expires_at' => Carbon::now()->subHour(),
        ]);
        Pix::factory()->count(1)->for($user)->create([
            'status' => 'paid',
            'expires_at' => Carbon::now()->subDay(),
        ]);
        $this->artisan('pix:expire')
             ->expectsOutput('3 PIX expirados automaticamente.')
             ->assertExitCode(0);
        $this->assertEquals(3, Pix::where('status', 'expired')->count());
        $this->assertEquals(2, Pix::where('status', 'generated')->count());
        $this->assertEquals(1, Pix::where('status', 'paid')->count());
    }
}
