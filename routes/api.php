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

;

Route::get('v1/tactics', [TacticController::class, 'index']);
Route::get('v1/techniques', [TechniqueController::class, 'index']);
Route::get('v1/techniques/{id}/{subId}', [TechniqueController::class, 'show']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
