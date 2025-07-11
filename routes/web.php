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

Route::group(['prefix' => 'user', 'middleware' => ['auth']], function () {
    Route::group(['middleware' => ['cek_login']], function () {
        // Route Xpro
        Route::group(['prefix' => 'xpro'], function () {
            Route::get('/', [XproController::class, 'index'])->name('xpro.index');
            Route::post('/list', [XproController::class, 'list'])->name('xpro.list');
            Route::get('/import', [XproController::class, 'import'])->name('xpro.import');
            Route::post('/import-proses', [XproController::class, 'import_proses'])->name('xpro.import-proses');
            Route::post('/send-to-telegram', [XproController::class, 'sendToTelegram'])->name('xpro.send-to-telegram');
        });

        // Route Orbit
        Route::group(['prefix' => 'orbit'], function () {
            Route::get('/', [OrbitController::class, 'index'])->name('orbit.index');
            Route::post('/list', [OrbitController::class, 'list'])->name('orbit.list');
            Route::get('/import', [OrbitController::class, 'import'])->name('orbit.import');
            Route::post('/import-proses', [OrbitController::class, 'import_proses'])->name('orbit.import-proses');
            Route::post('/send-to-telegram', [OrbitController::class, 'sendToTelegram'])->name('orbit.send-to-telegram');
        });

        // Route Endstate
        Route::group(['prefix' => 'endstate'], function () {
            Route::get('/', [EndstateController::class, 'index'])->name('endstate.index');
            Route::post('/list', [EndstateController::class, 'list'])->name('endstate.list');
            Route::post('/', [EndstateController::class, 'store'])->name('endstate.store');
            // ERROR UNDEFINED VARIABLE $ENDSTATE
            // Route::get('/edit', [EndstateController::class, 'edit'])->name('endstate.edit');
            // Route::put('/update/{id_endstate}', [EndstateController::class, 'update'])->name('endstate.update');
            Route::get('/import', [EndstateController::class, 'import'])->name('endstate.import');
            Route::post('/import-proses', [EndstateController::class, 'import_proses'])->name('endstate.import-proses');
            Route::post('/send-to-telegram', [EndstateController::class, 'sendToTelegram'])->name('endstate.send-to-telegram');
        });

        // Route Pivot Endstate
        Route::group(['prefix' => 'pivotendstate'], function () {
            Route::get('/', [PivotEndstateController::class, 'index'])->name('pivotendstate.index');
            Route::post('/list', [PivotEndstateController::class, 'list'])->name('pivotendstate.list');
            Route::post('/send-to-telegram', [PivotEndstateController::class, 'sendToTelegram'])->name('pivotendstate.send-to-telegram');
        });

        // Route ProviManja
        Route::group(['prefix' => 'provimanja'], function () {
            Route::get('/', [ProviManjaController::class, 'index'])->name('provimanja.index');
            Route::post('/list', [ProviManjaController::class, 'list'])->name('provimanja.list');
            Route::post('/', [ProviManjaController::class, 'store'])->name('provimanja.store');
            Route::get('/import', [ProviManjaController::class, 'import'])->name('provimanja.import');
            Route::post('/import-proses', [ProviManjaController::class, 'import_proses'])->name('provimanja.import-proses');
            Route::post('/send-to-telegram', [ProviManjaController::class, 'sendToTelegram'])->name('provimanja.send-to-telegram');
        });

        // Route ProviKpro
        Route::group(['prefix' => 'provikpro'], function () {
            Route::get('/', [ProviKproController::class, 'index'])->name('provikpro.index');
            Route::post('/list', [ProviKproController::class, 'list'])->name('provikpro.list');
            Route::post('/', [ProviKproController::class, 'store'])->name('provikpro.store');
            Route::post('/send-to-telegram', [ProviKproController::class, 'sendToTelegram'])->name('provikpro.send-to-telegram');
        });

        // Route Profile
        Route::group(['prefix' => 'profile'], function () {
            Route::get('/{id}', [ProfileController::class, 'index'])->name('profile.index');
            Route::post('/reset/{id}', [ProfileController::class, 'reset'])->name('profile.reset');
        });
    });
});
