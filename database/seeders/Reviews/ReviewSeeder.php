<?php

namespace Database\Seeders\Reviews;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Reviews\Review;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = file_get_contents(database_path('seeders/Reviews/reviews.json'));
        $data = json_decode($json, true);

        // Insert data into the database
        foreach ($data as $item) {

            Review::create($item);
        }
    }
}
