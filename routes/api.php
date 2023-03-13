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

Route::get('/desa/{id}', [\App\Http\Controllers\DesaController::class, 'show']);
Route::get('/desa', [\App\Http\Controllers\DesaController::class, 'index']);
Route::post('/desa', [\App\Http\Controllers\DesaController::class, 'store']);
Route::put('/desa/{id}', [\App\Http\Controllers\DesaController::class, 'update']);

Route::get('/pelaksana-program/{id}', [\App\Http\Controllers\PelaksanaProgramController::class, 'show']);
Route::get('/pelaksana-program', [\App\Http\Controllers\PelaksanaProgramController::class, 'index']);
Route::post('/pelaksana-program', [\App\Http\Controllers\PelaksanaProgramController::class, 'store']);
Route::put('/pelaksana-program/{id}', [\App\Http\Controllers\PelaksanaProgramController::class, 'update']);
Route::delete('/pelaksana-program/{id}', [\App\Http\Controllers\PelaksanaProgramController::class, 'destroy']);

Route::get('/program/{id}', [\App\Http\Controllers\ProgramDesaController::class, 'show']);
Route::get('/program', [\App\Http\Controllers\ProgramDesaController::class, 'index']);
Route::post('/program', [\App\Http\Controllers\ProgramDesaController::class, 'store']);
Route::put('/program/{id}', [\App\Http\Controllers\ProgramDesaController::class, 'update']);
Route::delete('/program/{id}', [\App\Http\Controllers\ProgramDesaController::class, 'destroy']);

Route::get('/users/{id}', [\App\Http\Controllers\UserController::class, 'show']);
Route::get('/users', [\App\Http\Controllers\UserController::class, 'index']);
Route::post('/users', [\App\Http\Controllers\UserController::class, 'store']);
Route::put('/users/{id}', [\App\Http\Controllers\UserController::class, 'update']);

Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout']);
Route::get('/verify-email/{token}', [\App\Http\Controllers\AuthController::class, 'verifyEmail']);
Route::post('/send-email-verification-link', [\App\Http\Controllers\AuthController::class, 'sendEmailVerificationLink']);
