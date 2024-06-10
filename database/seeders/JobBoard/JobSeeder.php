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
        // create 100 jobs
        Job::factory()->count(5)->create();
    }
}
