<?php

namespace App\Http\Controllers\OlympicGames;

use App\Http\Controllers\Controller;
use App\Models\OlympicGames\Event;
use Illuminate\Support\Facades\Http;

class EventFetcher extends Controller
{
    public function fetchNewEvents()
    {

        // pass headers
        // from 2024-07-24 to 2024-08-11

        $arrayOfDates = [
            '2024-07-24',
            '2024-07-25',
            '2024-07-26',
            '2024-07-27',
            '2024-07-28',
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

        return 'Events fetched';
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
}
