<?php

namespace Database\Seeders\Bloquinhos2025;

use App\Models\Bloquinhos2025\Agenda;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class Bloquinhos2025Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $agenda = json_decode(file_get_contents(__DIR__.'/agenda.json'), true);

        $agenda = array_map(function ($item) {
            $item['date_time'] = Carbon::parse($item['date_time'])->format('Y-m-d H:i:s');
            return $item;
        }, $agenda);

        dd($agenda);
        foreach ($agenda as $agendaItem) {
            Agenda::create($agendaItem);
        }

    }
}
