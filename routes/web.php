<?php

use App\Http\Controllers\B\AuthController;
use App\Http\Controllers\F\UndanganController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// * frontend
Route::get('/', [UndanganController::class,'index']);

// * backend
// AUTH
Route::get('login', [AuthController::class,'login'])->name('login');
Route::post('login', [AuthController::class,'auth']);
Route::post('logout', [AuthController::class,'logout']);

// dashboard admin
Route::get('login', [AuthController::class,'login'])->name('login');




