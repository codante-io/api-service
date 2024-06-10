<?php

use App\Http\Controllers\FrasesMotivacionais\QuoteController;
use App\Http\Controllers\JobBoard\JobController;
use App\Http\Controllers\Orders\OrderController;
use Illuminate\Support\Facades\Route;

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
    Route::delete('/jobs/{job}', [JobController::class, 'destroy']);
    Route::get('/jobs/{job}', [JobController::class, 'show']);
    Route::get('/reset', [JobController::class, 'reset']);
});
