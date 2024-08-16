<?php

namespace Database\Seeders\OlympicGames;

use App\Models\OlympicGames\Country;
use App\Models\OlympicGames\Discipline;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddParalympicSports extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $paralympicSports = [
        'FBB' => 'Blind Football',
        'BOC' => 'Boccia',
        'GBL' => 'Goalball',
        'ARC' => 'Para Archery',
        'ATH' => 'Para Athletics',
        'BDM' => 'Para Badminton',
        'CSP' => 'Para Canoe',
        'CRD' => 'Para Cycling Road',
        'CTR' => 'Para Cycling Track',
        'EQU' => 'Para Equestrian',
        'JUD' => 'Para Judo',
        'PWL' => 'Para Powerlifting',
        'ROW' => 'Para Rowing',
        'SWM' => 'Para Swimming',
        'TTE' => 'Para Table Tennis',
        'TKW' => 'Para Taekwondo',
        'TRI' => 'Para Triathlon',
        'SHO' => 'Shooting Para Sport',
        'VBS' => 'Sitting Volleyball',
        'WBK' => 'Wheelchair Basketball',
        'WFE' => 'Wheelchair Fencing',
        'WRU' => 'Wheelchair Rugby',
        'WTE' => 'Wheelchair Tennis',
    ];
       
    
    foreach($paralympicSports as $code => $name) {
        Discipline::create([
            'id' => "P-" . $code,
            'name' => $name,
            'is_paralympic' => true,
            'pictogram_url' => "https://assets.codante.io/codante-apis/olympic-games/pictograms/$code.avif",
        ]);


       
    }
  }
}
