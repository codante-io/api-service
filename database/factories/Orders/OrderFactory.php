<?php

namespace Database\Factories\Orders;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Orders\Order>
 */
class OrderFactory extends Factory
{
    public function definition(): array
    {

        $firstName = $this->faker->firstName();
        $lastName = $this->faker->lastName();

        return [
            'customer_name' => $firstName.' '.$lastName,
            'customer_email' => Str::lower($firstName.'.'.$lastName.'@'.$this->faker->safeEmailDomain()),
            'status' => $this->faker->randomElement(['pending', 'completed']),
            'order_date' => $this->faker->date(),
            'amount_in_cents' => $this->faker->numberBetween(100, 10000),
        ];
    }
}
