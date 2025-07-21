<?php

namespace Database\Factories;

use App\Models\Pix;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pix>
 */
class PixFactory extends Factory
{
    /**
     * The name of the corresponding model.
     *
     * @var string
     */
    protected $model = Pix::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'token' => (string) Str::uuid(),
            'status' => fake()->randomElement(['generated', 'paid', 'expired']), 
            'expires_at' => Carbon::now()->addMinutes(fake()->numberBetween(5, 60))
        ];
    }

    public function generated(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'generated',
        ]);
    }

    public function paid(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'paid',
        ]);
    }

    public function expired(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'expired',
            'expires_at' => Carbon::now()->subMinutes(10),
        ]);
    }
}