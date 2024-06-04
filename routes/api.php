<?php

use App\Http\Controllers\AuthController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::middleware('auth:sanctum')
Route::post('/v1/auth/signup', [ AuthController::class, 'signup' ]);
Route::post('/v1/auth/signin', [ AuthController::class, 'signin' ]);
Route::middleware('auth:sanctum')->post('/v1/auth/signout', [ AuthController::class, 'signout' ]);