<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/newcompetition', [App\Http\Controllers\CompetitionController::class, 'index'])->name('newcompetition');
Route::post('/newcompetition', [App\Http\Controllers\CompetitionController::class, 'addCompetition']);
Route::get('/competitions', [App\Http\Controllers\CompetitionController::class, 'getAllCompetition']);
Route::get('/competition/{id}', [App\Http\Controllers\CompetitionController::class, 'getCompetition']);
