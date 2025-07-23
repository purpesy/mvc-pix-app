<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Pix;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_is_accessible_by_authenticated_users()
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/dashboard');

        $response->assertStatus(200);
    }

    public function test_dashboard_is_not_accessible_by_guests()
    {
        $response = $this->get('/dashboard');

        $response->assertRedirect('/login');
    }

    public function test_dashboard_displays_correct_pix_counts()
{
    /** @var \App\Models\User $user */
    $user = User::factory()->create();

    Pix::factory()->count(3)->for($user)->create(['status' => 'generated']);
    Pix::factory()->count(2)->for($user)->create(['status' => 'paid']);
    Pix::factory()->count(1)->for($user)->create(['status' => 'expired']);

    $this->actingAs($user);

    $response = $this->get('/dashboard');

    $response->assertSeeText('Gerados: 3');
    $response->assertSeeText('Pagos: 2');
    $response->assertSeeText('Expirados: 1');
}


    public function test_dashboard_loads_quickly_with_many_records()
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create();

        Pix::factory()->count(1000)->for($user)->create(['status' => 'generated']);

        $this->be($user);

        $start = microtime(true);

        $response = $this->get('/dashboard');

        $end = microtime(true);
        $durationMs = ($end - $start) * 1000;

        $response->assertStatus(200);
        $this->assertLessThan(300, $durationMs, "Dashboard demorou mais de 300ms");
    }
}
