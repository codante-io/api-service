<?php

namespace Database\Factories\JobBoard;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobBoard\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->jobTitle,
            'company' => $this->faker->company,
            'company_website' => $this->faker->url,
            'city' => $this->faker->city,
            'schedule' => $this->faker->randomElement(['full-time', 'part-time']),
            'salary' => $this->faker->randomFloat(2, 1000, 10000),
            'description' => $this->faker->text,
            'requirements' => $this->faker->text,
        ];
    }
}
