<?php

use Illuminate\Support\Facades\Route;

// create a home
Route::get('/', function () {
    return response()->json(['message' => 'Codante.io APIs Service. For docs, visit https://apis-docs.codante.io/']);
});
