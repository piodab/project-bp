<?php

use App\Http\Controllers\TechniqueController;
use App\Http\Controllers\TacticController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('tactics')->name('tactics.')->group(
    function () {
        Route::get('/enterprise', [TacticController::class, 'index'])->name('index');
        Route::get('/{id}', [TacticController::class, 'show'])->name('show');
    }
);

Route::prefix('techniques')->name('techniques.')->group(
    function () {
        Route::get('/{id}/{subId}', [TechniqueController::class, 'show'])->name('show');
        Route::get('/{id}', [TechniqueController::class, 'show'])->name('main.show');
    }
);

Route::get(
    '/',
    function () {
        return redirect()->route('tactics.index');
    }
);
