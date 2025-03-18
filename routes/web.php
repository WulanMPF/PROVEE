<?php

use App\Http\Controllers\AuthController;
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
Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/login-proses', [AuthController::class, 'proses_login'])->name('login-proses');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// RESET PASSWORD GAISO
Route::post('/reset-password', [ProfileController::class, 'reset_password'])->name('profile.reset-password');

Route::group(['prefix' => 'user', 'middleware' => ['auth']], function () {
    Route::group(['middleware' => ['cek_login']], function () {
        // Route Xpro
        Route::group(['prefix' => 'xpro'], function () {
            Route::get('/', [XproController::class, 'index'])->name('xpro.index');
            Route::post('/list', [XproController::class, 'list'])->name('xpro.list');
            Route::post('/', [XproController::class, 'store'])->name('xpro.store');
        });

        // Route Orbit
        Route::group(['prefix' => 'orbit'], function () {
            Route::get('/', [OrbitController::class, 'index'])->name('orbit.index');
            Route::post('/list', [OrbitController::class, 'list'])->name('orbit.list');
            Route::post('/', [OrbitController::class, 'store'])->name('orbit.store');
        });

        // Route Pivot Endstate
        Route::group(['prefix' => 'pivotendstate'], function () {
            Route::get('/', [PivotEndstateController::class, 'index'])->name('pivotendstate.index');
            Route::post('/list', [PivotEndstateController::class, 'list'])->name('pivotendstate.list');
            Route::post('/', [PivotEndstateController::class, 'store'])->name('pivotendstate.store');
        });

        // Route Endstate
        Route::group(['prefix' => 'endstate'], function () {
            Route::get('/', [EndstateController::class, 'index'])->name('endstate.index');
            Route::post('/list', [EndstateController::class, 'list'])->name('endstate.list');
            Route::post('/', [EndstateController::class, 'store'])->name('endstate.store');
        });

        // Route ProviManja
        Route::group(['prefix' => 'provimanja'], function () {
            Route::get('/', [ProviManjaController::class, 'index'])->name('provimanja.index');
            Route::post('/list', [ProviManjaController::class, 'list'])->name('provimanja.list');
            Route::post('/', [ProviManjaController::class, 'store'])->name('provimanja.store');
        });

        // Route ProviKpro
        Route::group(['prefix' => 'provikpro'], function () {
            Route::get('/', [ProviKproController::class, 'index'])->name('provikpro.index');
            Route::post('/list', [ProviKproController::class, 'list'])->name('provikpro.list');
            Route::post('/', [ProviKproController::class, 'store'])->name('provikpro.store');
        });

        // Route Profile
        Route::group(['prefix' => 'profile'], function () {
            Route::get('/', [ProfileController::class, 'index'])->name('profile.index');
        });
    });
});
