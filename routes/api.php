<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/desa/{id}', 'App\Http\Controllers\DesaController@show');
Route::get('/desa', 'App\Http\Controllers\DesaController@index');
Route::post('/desa', [\App\Http\Controllers\DesaController::class, 'store']);
Route::put('/desa/{id}', 'App\Http\Controllers\DesaController@update');


Route::get('/pelaksana-program/{id}', 'App\Http\Controllers\PelaksanaProgramController@show');
Route::get('/pelaksana-program', 'App\Http\Controllers\PelaksanaProgramController@index');
Route::post('/pelaksana-program', [\App\Http\Controllers\PelaksanaProgramController::class, 'store']);
Route::put('/pelaksana-program/{id}', 'App\Http\Controllers\PelaksanaProgramController@update');
Route::delete('/pelaksana-program/{id}', 'App\Http\Controllers\PelaksanaProgramController@destroy');


Route::get('/program/{id}', 'App\Http\Controllers\ProgramDesaController@show');
Route::get('/program', 'App\Http\Controllers\ProgramDesaController@index');
Route::post('/program', [\App\Http\Controllers\ProgramDesaController::class, 'store']);
Route::put('/program/{id}', 'App\Http\Controllers\ProgramDesaController@update');
Route::delete('/program/{id}', 'App\Http\Controllers\ProgramDesaController@destroy');


Route::get('/users/{id}', 'App\Http\Controllers\UserController@show');
Route::get('/users', 'App\Http\Controllers\UserController@index');
Route::post('/users', [\App\Http\Controllers\UserController::class, 'store']);
Route::put('/users/{id}', 'App\Http\Controllers\UserController@update');
