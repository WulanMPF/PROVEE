<?php

use App\Http\Controllers\EndstateController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrbitController;
use App\Http\Controllers\PivotEndstateController;
use App\Http\Controllers\ProviKproController;
use App\Http\Controllers\ProviManjaController;
use App\Http\Controllers\XproController;

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

// Route Login Page
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/login-proses', [LoginController::class, 'login_proses'])->name('login-proses');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route Xpro
Route::group(['prefix' => 'xpro'], function () {
    Route::get('/', [XproController::class, 'index']);                                  // Tampilkan halaman awal
    Route::post('/list', [XproController::class, 'list'])->name('xpro.list');           // Tampilkan form upload file (?)
    Route::post('/', [XproController::class, 'store'])->name('xpro.store');             // Save data baru
});

// Route Orbit
Route::group(['prefix' => 'orbit'], function () {
    Route::get('/', [OrbitController::class, 'index']);                                  // Tampilkan halaman awal
    Route::post('/list', [OrbitController::class, 'list'])->name('orbit.list');                          // Tampilkan form upload file (?)
    Route::post('/', [OrbitController::class, 'store'])->name('orbit.store');             // Save data baru
});

// Route Pivot Endstate
Route::group(['prefix' => 'pivotendstate'], function () {
    Route::get('/', [PivotEndstateController::class, 'index']);                                  // Tampilkan halaman awal
    Route::post('/list', [PivotEndstateController::class, 'list'])->name('pivotendstate.list');                          // Tampilkan form upload file (?)
    Route::post('/', [PivotEndstateController::class, 'store'])->name('pivotendstate.store');             // Save data baru
});

// Route Endstate
Route::group(['prefix' => 'endstate'], function () {
    Route::get('/', [EndstateController::class, 'index']);                              
    Route::post('/list', [EndstateController::class, 'list'])->name('endstate.list');            
    Route::post('/', [EndstateController::class, 'store'])->name('endstate.store');           
});

// Route ProviManja
Route::group(['prefix' => 'provimanja'], function () {
    Route::get('/', [ProviManjaController::class, 'index']);                              
    Route::post('/list', [ProviManjaController::class, 'list'])->name('provimanja.list');            
    Route::post('/', [ProviManjaController::class, 'store'])->name('provimanja.store');           
});

// Route ProviKpro
Route::group(['prefix' => 'provikpro'], function () {
    Route::get('/', [ProviKproController::class, 'index']);                              
    Route::post('/list', [ProviKproController::class, 'list'])->name('provikpro.list');            
    Route::post('/', [ProviKproController::class, 'store'])->name('provikpro.store');           
});

Route::get('/profile', [ProfileController::class, 'index']);
// Route::get('/', [WelcomeController::class, 'index']);
