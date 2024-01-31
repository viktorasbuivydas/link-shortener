<?php

use App\Http\Controllers\Api\LinkController;
use Illuminate\Support\Facades\Route;

Route::name('links.')
    ->controller(LinkController::class)
    ->group(function () {
        Route::post('/links/create', 'store')->name('store');
    });

