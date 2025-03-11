<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\WelcomeController;

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
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login-proses', [LoginController::class, 'login_proses'])->name('login-proses');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route::get('/xpro', [XproController::class, 'index'])->middleware('auth')->name('xpro.index');

// Route::get('/dashboard', function () {
//     return 'Welcome to Dashboard';
// })->middleware('auth')->name('dashboard');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::get('/', [WelcomeController::class, 'index']);