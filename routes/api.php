<?php

use App\Http\Controllers\AgamaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\DesaController;
use App\Http\Controllers\GenderController;
use App\Http\Controllers\KabupatenController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\PatnerController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\PropinsiController;
use App\Http\Controllers\StatusController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum'])->group(function() {    
  Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
  Route::get('/user', function (Request $request) {
    return $request->user();
  })->name('user');
});

Route::apiResource('agamas', AgamaController::class);
Route::apiResource('clubs', ClubController::class);
Route::apiResource('desas', DesaController::class);
Route::apiResource('genders', GenderController::class);
Route::apiResource('kabupatens', KabupatenController::class); 
Route::apiResource('kecamatans', KecamatanController::class);
Route::apiResource('patners', PatnerController::class);
Route::apiResource('people', PersonController::class);
Route::apiResource('propinsis', PropinsiController::class);
Route::apiResource('statuses', StatusController::class);

Route::post('/register/{jenis_register}', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');