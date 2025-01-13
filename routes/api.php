<?php

use App\Http\Controllers\PropinsiController;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::apiResource('propinsis', PropinsiController::class);