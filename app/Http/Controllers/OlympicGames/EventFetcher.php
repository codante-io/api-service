<?php

namespace App\Http\Controllers\OlympicGames;

use App\Models\OlympicGames\Country;
use App\Models\OlympicGames\Event;
use Illuminate\Support\Facades\Http;

class EventFetcher
{
    public function fetchNewEvents()
    {

        // pass headers
        // from 2024-07-24 to 2024-08-11

        $arrayOfDates = [
            // '2024-07-24',
            // '2024-07-25',
            // '2024-07-26',
            // '2024-07-27',
            // '2024-07-28',
            '2024-07-29',
            '2024-07-30',
            '2024-07-31',
            '2024-08-01',
            '2024-08-02',
            '2024-08-03',
            '2024-08-04',
            '2024-08-05',
            '2024-08-06',
            '2024-08-07',
            '2024-08-08',
            '2024-08-09',
            '2024-08-10',
            '2024-08-11',
        ];

        foreach ($arrayOfDates as $date) {
            $eventsData = Http::withHeaders(['user-agent' => 'Insomnia 9.1'])->get('https://sph-s-api.olympics.com/summer/schedules/api/ENG/schedule/day/'.$date)->json();

            $events = $eventsData['units'];

            foreach ($events as $event) {
                $createdEvent = Event::updateOrCreate([
                    'original_id' => $event['id'],

                ], [
                    'original_id' => $event['id'],
                    'day' => $event['olympicDay'],
                    'discipline_id' => $event['disciplineCode'],
                    'discipline_name' => $event['disciplineName'],
                    'venue_id' => $event['venue'] ?? '',
                    'venue_name' => $event['venueDescription'] ?? '',
                    'event_name' => $event['eventName'],
                    'event_unit_name' => $event['eventUnitName'],
                    'event_name_portuguese' => '',
                    'start_date' => $event['startDate'],
                    'end_date' => $event['endDate'] ?? '',
                    'status' => $event['statusDescription'] ?? '',
                    'is_medal_event' => $event['medalFlag'] ?? false,
                    'is_live' => $event['liveFlag'] ?? false,
                    'gender_code' => $event['genderCode'] ?? '',
                ]);

                if (! isset($event['competitors'])) {
                    continue;
                }

                foreach ($event['competitors'] as $competitor) {
                    $createdEvent->competitors()->updateOrCreate(
                        [
                            'event_original_competitor_original' => $event['id'].$competitor['code'],
                        ],
                        [
                            'original_id' => $competitor['code'],
                            'country_id' => $competitor['noc'] ?? '',
                            'name' => $competitor['name'],
                            'position' => $competitor['order'],
                            'result_position' => $competitor['results']['position'] ?? '',
                            'result_winnerLoserTie' => $competitor['results']['winnerLoserTie'] ?? '',
                            'result_mark' => $competitor['results']['mark'] ?? '',
                        ]);
                }

            }

            usleep(300);
        }

        // send discord message

    }

    public function fetchFromAllDates()
    {
        $eventsData = Http::withHeaders(['user-agent' => 'Insomnia 9.1'])->get('https://sph-s-api.olympics.com/summer/schedules/api/ENG/schedule/');

        $events = $eventsData['units'];

        foreach ($events as $event) {

            $createdEvent = Event::updateOrCreate([
                'original_id' => $event['id'],

            ], [
                'original_id' => $event['id'],
                'day' => $event['olympicDay'],
                'discipline_id' => $event['disciplineCode'],
                'discipline_name' => $event['disciplineName'],
                'venue_id' => $event['venue'] ?? '',
                'venue_name' => $event['venueDescription'] ?? '',
                'event_name' => $event['eventName'],
                'event_unit_name' => $event['eventUnitName'],
                'event_name_portuguese' => '',
                'start_date' => $event['startDate'],
                'end_date' => $event['endDate'] ?? '',
                'status' => $event['statusDescription'] ?? '',
                'is_medal_event' => $event['medalFlag'] ?? false,
                'is_live' => $event['liveFlag'] ?? false,
                'gender_code' => $event['genderCode'] ?? '',
            ]);

            if (! isset($event['competitors'])) {
                continue;
            }

            foreach ($event['competitors'] as $competitor) {
                $createdEvent->competitors()->updateOrCreate(
                    [
                        'event_original_competitor_original' => $event['id'].$competitor['code'],
                    ],
                    [
                        'original_id' => $competitor['code'],
                        'country_id' => $competitor['noc'] ?? '',
                        'name' => $competitor['name'],
                        'position' => $competitor['order'],
                        'result_position' => $competitor['results']['position'] ?? '',
                        'result_winnerLoserTie' => $competitor['results']['winnerLoserTie'] ?? '',
                        'result_mark' => $competitor['results']['mark'] ?? '',
                    ]
                );
            }

        }

        return response()->json(['message' => 'Events Fetched']);
    }

    public function fetchMedals()
    {
        $medals = Http::withHeaders(['user-agent' => 'Insomnia 9.1'])->get('https://sph-c-api.olympics.com/summer/competition/api/ENG/medals')->json();

        $medalsTable = $medals['medalStandings']['medalsTable'];

        foreach ($medalsTable as $medalTableItem) {
            $country = Country::find($medalTableItem['organisation']);

            // total medals - filter item of array where Type = Total
            $medals = collect($medalTableItem['medalsNumber'])->filter(function ($item, $key) {
                return $item['type'] === 'Total';
            })->first();

            $gold = $medals['gold'] ?? 0;
            $silver = $medals['silver'] ?? 0;
            $bronze = $medals['bronze'] ?? 0;
            $total = $medals['total'] ?? 0;
            $rank = $medalTableItem['rank'] ?? 0;
            $rankTotalMedals = $medalTableItem['rankTotal'] ?? 0;

            if (! $country) {
                continue;
            }

            $country->update([
                'gold_medals' => $gold,
                'silver_medals' => $silver,
                'bronze_medals' => $bronze,
                'total_medals' => $total,
                'rank' => $rank,
                'rank_total_medals' => $rankTotalMedals,
            ]);
        }
    }
}
