<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [ HomeController::class, 'getDashboard' ])->name('home')->middleware('auth:sanctum');
Route::get('/update', [ HomeController::class, 'getUpdate' ])->name('update')->middleware('auth:sanctum');

Route::post('/data/create', [ HomeController::class, 'addData' ])->middleware('auth:sanctum');
Route::post('/data/delete', [ HomeController::class, 'deleteData' ])->middleware('auth:sanctum');
Route::post('/data/update', [ HomeController::class, 'updateData' ])->middleware('auth:sanctum');

Route::get('/signup', [ AuthController::class, 'getSignUp' ])->name('signup');
Route::post('/signup', [ AuthController::class, 'postSignUp' ]);

Route::get('/signin', [ AuthController::class, 'getSignIn' ])->name('signin');
Route::post('/signin', [ AuthController::class, 'postSignIn' ]);

Route::post('/signout', [ AuthController::class, 'postSignOut' ]);