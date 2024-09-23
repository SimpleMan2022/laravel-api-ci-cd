<?php

use App\Http\Controllers\FoodController;
use App\Models\food;
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

Route::get('/foods', [FoodController::class, 'index']);
Route::post('/foods', [FoodController::class, 'create']);
Route::get('/foods/{id}', [FoodController::class, 'findById']);
