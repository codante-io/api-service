<?php

namespace Database\Seeders;

use App\APIs\FrasesMotivacionais\Quote;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = file_get_contents(app_path('APIs/FrasesMotivacionais/quotes.json'));
        $data = json_decode($json, true);

        // Insert data into the database
        foreach ($data as $item) {

            Quote::create($item);
        }

    }
}
