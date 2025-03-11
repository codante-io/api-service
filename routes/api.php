<?php

use App\Http\Controllers\Bloquinhos2025\Bloquinhos2025Controller;
use App\Http\Controllers\BrazilFlags\BrazilFlagsController;
use App\Http\Controllers\FrasesMotivacionais\QuoteController;
use App\Http\Controllers\JobBoard\JobController;
use App\Http\Controllers\OlympicGames\EventController;
use App\Http\Controllers\Orders\OrderController;
use App\Http\Controllers\RegisterUser\RegisterUserController;
use App\Http\Controllers\Reviews\ReviewController;
use App\Http\Controllers\SenatorExpenses\ExpenseController;
use App\Http\Controllers\SenatorExpenses\PartyController;
use App\Http\Controllers\SenatorExpenses\SenatorController;
use App\Http\Controllers\LegadoFeminino\LegadoFemininoController;
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

    Route::middleware(['throttle:api'])->prefix('reviews-api')->group(function () {
        Route::get('/reviews', [ReviewController::class, 'show']);
        Route::post('/reviews', [ReviewController::class, 'create']);
        Route::put('/reviews/{id}', [ReviewController::class, 'update']);
        Route::delete('/reviews/{id}', [ReviewController::class, 'delete']);
        Route::get('/reviews/{id}', [ReviewController::class, 'showOne']);
        Route::get('/reset', [ReviewController::class, 'reset']);
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
        Route::delete('/jobs/{job}', [JobController::class, 'destroy']);
        Route::get('/jobs/{job}', [JobController::class, 'show']);
        Route::get('/jobs/{job}/comments', [JobController::class, 'commentsIndex']);
        Route::get('/reset', [JobController::class, 'reset']);
        // Route::put('/jobs/{job}', [JobController::class, 'update']);
    });

    Route::middleware(['throttle:api'])->prefix('bloquinhos2025')->group(function () {
        Route::get('/agenda', [Bloquinhos2025Controller::class, 'index']);
    });

    Route::middleware(['throttle:api'])->prefix('register-user')->group(function () {
        Route::post('/register', [RegisterUserController::class, 'validate']);
    });

    Route::middleware(['throttle:api'])->prefix('legadofeminino')->group(function () {
        Route::get('/woman', [LegadoFemininoController::class, 'index']);
    });

});

Route::middleware(['throttle:api'])->prefix('olympic-games')->group(function () {
    Route::get('/', [EventController::class, 'home']);
    Route::get('/fetch-events', [EventController::class, 'fetchNewEvents']);
    Route::get('/fetch-events1', [EventController::class, 'fetchFromAllDates']);
    Route::get('fetch-medals', [EventController::class, 'fetchMedals']);
    Route::get('/events/{event}', [EventController::class, 'show'])->middleware('cache.headers:public;max_age=120;etag');
    Route::get('/events', [EventController::class, 'index'])->middleware('cache.headers:public;max_age=120;etag');
    Route::get('/venues', [EventController::class, 'indexVenues'])->middleware('cache.headers:public;max_age=14400;etag');
    Route::get('/disciplines', [EventController::class, 'indexDisciplines'])->middleware('cache.headers:public;max_age=14400;etag');
    Route::get('/countries', [EventController::class, 'indexCountries'])->middleware('cache.headers:public;max_age=120;etag');
});

Route::middleware(['throttle:api'])->prefix('senator-expenses')->group(function () {
    Route::get('/', [SenatorController::class, 'home']);
    Route::get('/senators', [SenatorController::class, 'index'])->middleware('cache.headers:public;max_age=28800;etag');
    Route::get('/senators/{id}', [SenatorController::class, 'show'])->middleware('cache.headers:public;max_age=28800;etag');
    Route::get('/senators/{id}/expenses', [SenatorController::class, 'expenses'])->middleware('cache.headers:public;max_age=28800;etag');
    Route::get('/expenses', [ExpenseController::class, 'index'])->middleware('cache.headers:public;max_age=28800;etag');
    Route::get('/parties/{id}/expenses', [ExpenseController::class, 'partyExpenses'])->middleware('cache.headers:public;max_age=28800;etag');
    Route::get('/parties', [PartyController::class, 'index'])->middleware('cache.headers:public;max_age=28800;etag');
    Route::get('/uf/{uf}/expenses', [ExpenseController::class, 'UFExpenses'])->middleware('cache.headers:public;max_age=28800;etag');
    Route::get('summary/by-party', [ExpenseController::class, 'summaryByParty'])->middleware('cache.headers:public;max_age=28800;etag');
    Route::get('summary/by-uf', [ExpenseController::class, 'summaryByUF'])->middleware('cache.headers:public;max_age=28800;etag');
});

Route::middleware(['throttle:api'])->prefix('bandeiras-dos-estados')->group(function () {
    Route::get('/', [BrazilFlagsController::class, 'index'])->middleware('cache.headers:public;max_age=28800;etag');
});
