<?php

use App\Http\Controllers\DesaController;
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
Route::post('/desa', [DesaController::class, 'store']);
Route::put('/desa/{id}', 'DesaController@update');
