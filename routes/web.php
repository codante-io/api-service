<?php

use Illuminate\Support\Facades\Route;

// create a home
Route::get('/', function () {
    return response()->json(['message' => 'Codante.io APIs Service']);
});
