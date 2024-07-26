<?php

use Illuminate\Support\Facades\Route;

// create a home
Route::get('/', function () {
    return redirect('https://docs.apis.codante.io');
});
