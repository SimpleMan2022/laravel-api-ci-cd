<?php

use App\Http\Controllers\FoodController;
use App\Http\Controllers\UserController;
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

Route::prefix('/foods')->controller(FoodController::class)->middleware('auth:sanctum')->group(function () {
  Route::get('/', 'index');
  Route::post('/create', 'create');
  Route::get('/{id}', 'findById');
});

Route::post('/register', [UserController::class, 'create']);
Route::post('/login', [UserController::class, 'login']);
