<?php

use App\Http\Controllers\FrasesMotivacionais\QuoteController;
use App\Http\Controllers\JobBoard\JobController;
use App\Http\Controllers\OlympicGames\EventController;
use App\Http\Controllers\Orders\OrderController;
use App\Http\Controllers\RegisterUser\RegisterUserController;
use Illuminate\Support\Facades\Route;

Route::prefix('api')->group(function () {

    Route::middleware(['throttle:api'])->prefix('frases-api')->group(function () {
        Route::get('/frases', [QuoteController::class, 'show']);
        Route::post('/frases', [QuoteController::class, 'create']);
        Route::put('/frases/{id}', [QuoteController::class, 'update']);
        Route::delete('/frases/{id}', [QuoteController::class, 'delete']);
        Route::get('/frases/{id}', [QuoteController::class, 'showOne']);
        Route::get('/reset', [QuoteController::class, 'reset']);
    });

    Route::middleware(['throttle:api'])->prefix('orders-api')->group(function () {
        Route::get('/orders', [OrderController::class, 'index']);
        Route::post('/orders', [OrderController::class, 'store']);
        Route::delete('/orders/{order}', [OrderController::class, 'destroy']);
        Route::get('/orders/{order}', [OrderController::class, 'show']);
        Route::get('/reset', [OrderController::class, 'reset']);
    });

    Route::middleware(['throttle:api'])->prefix('job-board')->group(function () {
        Route::get('/jobs', [JobController::class, 'index']);
        Route::post('/jobs', [JobController::class, 'store']);
        Route::put('/jobs/{job}', [JobController::class, 'update']);
        Route::delete('/jobs/{job}', [JobController::class, 'destroy']);
        Route::get('/jobs/{job}', [JobController::class, 'show']);
        Route::get('/reset', [JobController::class, 'reset']);
    });

    Route::middleware(['throttle:api'])->prefix('register-user')->group(function () {
        Route::post('/register', [RegisterUserController::class, 'validate']);
    });

});

Route::middleware(['throttle:api'])->prefix('olympic-games')->group(function () {
    Route::get('/', [EventController::class, 'home']);
    Route::get('/fetch-events', [EventController::class, 'fetchNewEvents']);
    Route::get('/fetch-events1', [EventController::class, 'fetchFromAllDates']);
    Route::get('fetch-medals', [EventController::class, 'fetchMedals']);
    Route::get('/events/{event}', [EventController::class, 'show']);
    Route::get('/events', [EventController::class, 'index']);
    Route::get('/venues', [EventController::class, 'indexVenues']);
    Route::get('/disciplines', [EventController::class, 'indexDisciplines']);
    Route::get('/countries', [EventController::class, 'indexCountries']);
})->middleware('cache.headers:public;max_age=120;etag');
