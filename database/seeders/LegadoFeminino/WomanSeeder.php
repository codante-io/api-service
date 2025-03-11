<?php

namespace Database\Seeders\LegadoFeminino;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LegadoFeminino\Woman;

class WomanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = file_get_contents(database_path('seeders/LegadoFeminino/women.json'));
        $data = json_decode($json, true);
        foreach ($data["mulheres"] as $item) {
            Woman::create($item);
        }
    }
}
