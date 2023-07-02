<?php

use App\Http\Controllers\B\AuthController;
use App\Http\Controllers\B\DashboardController;
use App\Http\Controllers\B\Master\GaleryController;
use App\Http\Controllers\F\UndanganController;
use App\Http\Controllers\TujuanController;
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
Route::get('kepada/{slug}', [UndanganController::class,'show']);
Route::post('ucapan/store', [UndanganController::class,'store']);

// * backend
// AUTH
Route::get('login', [AuthController::class,'login'])->name('login');
Route::post('login', [AuthController::class,'auth']);
Route::post('logout', [AuthController::class,'logout']);

// dashboard admin
Route::get('dashboard', [DashboardController::class,'index']);

// * master
// master galery
Route::prefix('master')->group(function () {
    Route::get('/galery', [GaleryController::class,'index']);
    Route::post('/galery/store', [GaleryController::class,'store']);

    Route::get('/penerima', [TujuanController::class,'index']);
    Route::post('/penerima/store', [TujuanController::class,'store']);
});
