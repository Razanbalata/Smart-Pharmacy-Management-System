<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SaleFactory extends Factory
{
    public function definition(): array
    {
        $subtotal = fake()->randomFloat(2, 20, 500);
        $discount = fake()->randomFloat(2, 0, 20);
        $total = $subtotal - $discount;

        return [
            'user_id' => User::inRandomOrder()->first()->id,

            'subtotal' => $subtotal,
            'discount' => $discount,
            'total' => $total,

            'status' => fake()->randomElement([
                'draft',
                'completed',
                'cancelled',
            ]),
        ];
    }

    public function completed(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'completed',
        ]);
    }

    public function draft(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'draft',
        ]);
    }

    public function cancelled(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'cancelled',
        ]);
    }
}
