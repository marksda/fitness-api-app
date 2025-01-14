<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KabupatenController;
use App\Http\Controllers\PropinsiController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::middleware(['auth:sanctum'])->group(function() {
  Route::apiResource('propinsis', PropinsiController::class)->except(['index', 'show']);
  Route::apiResource('kabupatens', KabupatenController::class)->except(['index', 'show']);
  Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
Route::get('propinsis', [PropinsiController::class, 'index'])->name('kabupaten.index');
Route::get('propinsis', [PropinsiController::class, 'show'])->name('kabupaten.show');
Route::get('kabupatens', [KabupatenController::class, 'index'])->name('kabupaten.index');
Route::get('kabupatens', [KabupatenController::class, 'show'])->name('kabupaten.show');

// Route::apiResource('propinsis', PropinsiController::class);
// Route::post('/register', [AuthController::class, 'register']);
// Route::post('/login', [AuthController::class, 'login']);
// Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');