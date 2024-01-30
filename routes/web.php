<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use App\Http\Controllers\LinkController;
use Illuminate\Support\Facades\Route;

Route::prefix('links')
    ->name('links.')
    ->controller(LinkController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/create', 'store')->name('store');
    });

Route::get('/{link:hash}', [LinkController::class, 'show'])->name('links.show');
