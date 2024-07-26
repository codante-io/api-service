<?php

use App\Http\Controllers\OlympicGames\EventFetcher;
use Illuminate\Support\Facades\Schedule;

Schedule::command('api:orders-api:reset')->hourly();
Schedule::command('api:frases-motivacionais:reset')->hourly();
Schedule::command('api:job-board:reset')->hourly();

Schedule::call(function () {
    $eventFetcher = new EventFetcher();
    $eventFetcher->fetchNewEvents();
})->everyFiveMinutes();
