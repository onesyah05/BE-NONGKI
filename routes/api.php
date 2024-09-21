<?php

namespace App\Http\Controllers; 

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


Route::post('login', [AuthController::class, 'login']);
Route::post('signup', [AuthController::class, 'signup']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');


Route::group(['middleware' => 'auth:api'], function() {
    Route::get('profile', [ProfileController::class, 'show']);      // Melihat profil
    Route::put('profile', [ProfileController::class, 'update']);    // Mengedit profil
    Route::delete('profile', [ProfileController::class, 'delete']); // Menghapus profil
});
