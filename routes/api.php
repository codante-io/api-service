<?php

use App\APIs\FrasesMotivacionais\QuoteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/frases', [QuoteController::class, 'show']);
Route::post('/frases', [QuoteController::class, 'create']);
Route::put('/frases/{id}', [QuoteController::class, 'update']);
Route::delete('/frases/{id}', [QuoteController::class, 'delete']);
Route::get('/frases/{id}', [QuoteController::class, 'showOne']);
