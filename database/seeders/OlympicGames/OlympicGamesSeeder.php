<?php

namespace Database\Seeders\OlympicGames;

use App\Models\OlympicGames\Country;
use App\Models\OlympicGames\Discipline;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OlympicGamesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {



        $countries = Country::get();

        foreach($countries as $country) {
            $country->flag_url = "https://codante.s3.amazonaws.com/codante-apis/olympic-games/flags/$country->id.png"; 
            $country->created_at = now();
            $country->save();
        }

        $disciplines = Discipline::get();

        foreach($disciplines as $discipline) {
            $discipline->created_at = now();
            $discipline->pictogram_url = "https://codante.s3.amazonaws.com/codante-apis/olympic-games/pictograms/$discipline->id.png";
            $discipline->save();
        }
    }
}
