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

Route::get('tactics/enterprise', [TacticController::class, 'index'])->name('tactics.enterprise');
Route::get('tactics/{id}', [TacticController::class, 'show'])->name('tactics.show');
Route::get('techniques/{id}/{subId}', [TechniqueController::class, 'show'])->name('techniques.show');
Route::get('techniques/{id}', [TechniqueController::class, 'show'])->name('techniques.main.show');

Route::get('/', function () {
    return redirect()->route('tactics.enterprise');
});
