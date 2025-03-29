<?php

use Illuminate\Support\Facades\Route;

    Route::apiResource('/item', \App\Http\Controllers\SimpleCrudController::class);