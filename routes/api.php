<?php

use App\Enum\PermissionsEnum;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KabupatenController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\PropinsiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum'])->group(function() {    
  Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
  Route::get('/user', function (Request $request) {
    return $request->user();
  })->name('user');
});

Route::apiResource('propinsis', PropinsiController::class); 
Route::apiResource('kabupatens', KabupatenController::class);
Route::apiResource('kecamatans', KecamatanController::class);
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');