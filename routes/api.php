<?php

use App\Http\Controllers\FrasesMotivacionais\QuoteController;
use App\Http\Controllers\Orders\OrderController;
use Illuminate\Http\Request;
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
    Route::put('/orders/{id}', [OrderController::class, 'update']);
    Route::delete('/orders/{id}', [OrderController::class, 'destroy']);
    Route::get('/orders/{id}', [OrderController::class, 'show']);
    Route::get('/reset', [OrderController::class, 'reset']);
});
