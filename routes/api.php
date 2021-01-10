<?php

use App\Http\Controllers\Api\TechniqueController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\TacticController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->name('api.v1.')->group(
    function () {
        Route::prefix('tactics')->name('tactics.')->group(
            function () {
                Route::get('/', [TacticController::class, 'index'])->name('index');
            }
        );

        Route::prefix('techniques')->name('techniques.')->group(
            function () {
                Route::get('/', [TechniqueController::class, 'index'])->name('index');
                Route::get('/{id}/{subId}', [TechniqueController::class, 'show'])->name('show');
            }
        );
    }
);


Route::middleware('auth:api')->get(
    '/user',
    function (Request $request) {
        return $request->user();
    }
);
