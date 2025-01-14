<?php

namespace Database\Seeders\JobBoard;

use App\Models\JobBoard\Job;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $jobs = json_decode(file_get_contents(__DIR__.'/jobs.json'), true);

        foreach ($jobs as $job) {
            Job::create($job);
        }

        // Job::factory()->count(5)->create();
    }
}
