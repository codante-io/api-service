<?php

namespace Database\Factories\Orders;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Orders\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     * 
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_name' => $this->faker->firstName() . ' ' . $this->faker->lastName,
            'customer_email' => $this->faker->email(),
            'status' => $this->faker->randomElement(['pending', 'completed']),
            'order_date' => $this->faker->date(),
            'amount_in_cents' => $this->faker->numberBetween(100, 10000)
        ];
    }
}

