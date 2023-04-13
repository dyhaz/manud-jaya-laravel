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

Route::get('/program-desa/{id}', [\App\Http\Controllers\ProgramDesaController::class, 'show']);
Route::get('/program-desa', [\App\Http\Controllers\ProgramDesaController::class, 'index']);
Route::get('/program-desa-landing', [\App\Http\Controllers\ProgramDesaController::class, 'getProgramDesaLanding']);
Route::post('/program-desa', [\App\Http\Controllers\ProgramDesaController::class, 'store']);
Route::put('/program-desa/{id}', [\App\Http\Controllers\ProgramDesaController::class, 'update']);
Route::delete('/program-desa/{id}', [\App\Http\Controllers\ProgramDesaController::class, 'destroy']);

Route::get('/jenis-program', [\App\Http\Controllers\JenisProgramController::class, 'index']);
Route::post('/jenis-program', [\App\Http\Controllers\JenisProgramController::class, 'store']);

Route::get('/perizinan/{id}', [\App\Http\Controllers\PerizinanController::class, 'show']);
Route::get('/perizinan', [\App\Http\Controllers\PerizinanController::class, 'index']);
Route::get('/perizinan-by-email', [\App\Http\Controllers\PerizinanController::class, 'perizinanByEmail']);
Route::post('/perizinan', [\App\Http\Controllers\PerizinanController::class, 'store']);
Route::put('/perizinan/{id}', [\App\Http\Controllers\PerizinanController::class, 'update']);
Route::delete('/perizinan/{id}', [\App\Http\Controllers\PerizinanController::class, 'destroy']);

Route::get('/users/{id}', [\App\Http\Controllers\UserController::class, 'show']);
Route::get('/users', [\App\Http\Controllers\UserController::class, 'index']);
Route::post('/users', [\App\Http\Controllers\UserController::class, 'store']);
Route::put('/users/{id}', [\App\Http\Controllers\UserController::class, 'update']);
Route::get('/user-by-email/{email}', [\App\Http\Controllers\UserController::class, 'userByEmail']);
Route::post('/user/password', [\App\Http\Controllers\UserController::class, 'changePassword']);

Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout']);
Route::get('/verify-email/{token}', [\App\Http\Controllers\AuthController::class, 'verifyEmail']);
Route::post('/send-email-verification-link', [\App\Http\Controllers\AuthController::class, 'sendEmailVerificationLink']);

Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index']);
Route::get('/dashboard/anggaran', [\App\Http\Controllers\DashboardController::class, 'monthlyAnggaran']);
Route::get('/dashboard/anggaran/{year}', [\App\Http\Controllers\DashboardController::class, 'anggaranByMonth']);

Route::get('/warga2', [\App\Http\Controllers\WargaController::class, 'index2']);
Route::get('/warga/{id}', [\App\Http\Controllers\WargaController::class, 'show']);
Route::get('/warga', [\App\Http\Controllers\WargaController::class, 'index']);
Route::post('/warga', [\App\Http\Controllers\WargaController::class, 'store']);
Route::put('/warga/{id}', [\App\Http\Controllers\WargaController::class, 'update']);

Route::get('/jenis-perizinan/{id}', [\App\Http\Controllers\JenisPerizinanController::class, 'show']);
Route::get('/jenis-perizinan', [\App\Http\Controllers\JenisPerizinanController::class, 'index']);
Route::post('/jenis-perizinan', [\App\Http\Controllers\JenisPerizinanController::class, 'store']);
Route::put('/jenis-perizinan/{id}', [\App\Http\Controllers\JenisPerizinanController::class, 'update']);

Route::post('/assets', [\App\Http\Controllers\AssetController::class, 'upload']);
Route::get('/assets/{filename}', [\App\Http\Controllers\AssetController::class, 'download']);
Route::post('/assets2', [\App\Http\Controllers\AssetController::class, 'uploadBase64']);
