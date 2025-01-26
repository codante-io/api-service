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
        $jobs = json_decode(file_get_contents(__DIR__.'/../../../seeders/JobBoard/jobs.json'), true);
        $job = $this->faker->randomElement($jobs);

        return [
            'title' => $job['title'],
            'company' => $job['company'],
            'company_website' => $job['company_website'],
            'city' => $job['city'],
            'schedule' => $job['schedule'],
            'salary' => $job['salary'],
            'description' => $job['description'],
            'requirements' => $job['requirements'],
            'number_of_positions' => $job['number_of_positions'],
        ];
    }
}
