<?php

namespace Database\Seeders\FrasesMotivacionais;

use App\Models\FrasesMotivacionais\Quote;
use Illuminate\Database\Seeder;

class QuoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = file_get_contents(database_path('seeders/FrasesMotivacionais/quotes.json'));
        $data = json_decode($json, true);

        // Insert data into the database
        foreach ($data as $item) {

            Quote::create($item);
        }
    }
}
