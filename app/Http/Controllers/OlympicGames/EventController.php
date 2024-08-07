<?php

namespace App\Http\Controllers\OlympicGames;

use App\Http\Controllers\Controller;
use App\Http\Resources\OlympicGames\CountryResource;
use App\Http\Resources\OlympicGames\DisciplineResource;
use App\Http\Resources\OlympicGames\EventResource;
use App\Http\Resources\OlympicGames\VenueResource;
use App\Models\OlympicGames\Country;
use App\Models\OlympicGames\Discipline;
use App\Models\OlympicGames\Event;
use App\Models\OlympicGames\Venue;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function fetchNewEvents()
    {
        $eventFetcher = new EventFetcher();
        $events = $eventFetcher->fetchNewEvents();
    }

    public function fetchFromAllDates()
    {
        $eventFetcher = new EventFetcher();
        $events = $eventFetcher->fetchFromAllDates();
    }

    public function fetchMedals()
    {
        $eventFetcher = new EventFetcher();
        $events = $eventFetcher->fetchMedals();
    }

    public function show(Event $event)
    {
        return new EventResource($event);
    }

    public function index(Request $request)
    {

        $countryFilter = $request->query('country');
        $disciplineFilter = $request->query('discipline');
        $venueFilter = $request->query('venue');
        $dateFilter = $request->query('date');
        $competitorNameFilter = $request->query('competitor');
        $isLive = $request->query('live');
        $genderCode = $request->query('gender');

        $query = Event::query();

        if ($countryFilter) {
            $query->whereHas('competitors', function ($query) use ($countryFilter) {
                $query->where('country_id', $countryFilter);
            });
        }

        if ($disciplineFilter) {
            $query->where('discipline_id', $disciplineFilter);
        }

        if ($venueFilter) {
            $query->where('venue_id', $venueFilter);
        }

        if ($dateFilter) {
            $query->where('day', $dateFilter);
        }

        if ($competitorNameFilter) {
            $query->whereHas('competitors', function ($query) use ($competitorNameFilter) {
                $query->where('name', 'like', "%$competitorNameFilter%");
            });
        }

        if ($isLive) {
            $query->where('is_live', true);
        }

        if ($genderCode) {
            $query->where('gender_code', $genderCode);
        }

        $events = $query->with(['discipline', 'competitors', 'venue'])->paginate(10);

        return EventResource::collection($events);
    }

    public function indexVenues()
    {
        return VenueResource::collection(Venue::all());
    }

    public function indexCountries(Request $request)
    {
        // order by rank (1 first, 2 secnod, etc) but zeros should be last.
        return CountryResource::collection(Country::orderByRaw('rank = 0, rank')->paginate(50));
    }

    public function home()
    {
        return [
            'message' => 'Welcome to the Olympic Games API from codante.io. Have fun!',
            'endpoints' => [
                'events' => [
                    'url' => '/olympic-games/events',
                    'description' => 'List all events',
                    'query_parameters' => [
                        'country' => 'Filter by country',
                        'discipline' => 'Filter by discipline',
                        'venue' => 'Filter by venue',
                        'date' => 'Filter by date',
                        'competitor' => 'Filter by competitor name',
                    ],
                ],
                'countries' => [
                    'url' => '/olympic-games/countries',
                    'description' => 'List all countries',
                ],
                'venues' => [
                    'url' => '/olympic-games/venues',
                    'description' => 'List all venues',
                ],
                'disciplines' => [
                    'url' => '/olympic-games/disciplines',
                    'description' => 'List all disciplines (sports)',
                ],
                'medals' => 'To be defined.',
            ],
        ];
    }

    public function indexDisciplines()
    {
        // return Discipline::all();
        return DisciplineResource::collection(Discipline::all());
    }
}
