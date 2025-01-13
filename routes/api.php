<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PropinsiController;
use Illuminate\Support\Facades\Route;


Route::apiResource('propinsis', PropinsiController::class);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');