<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;

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

Route::get('/register', [AuthController::class, 'showReg'])->name('auth.register');
Route::post('/register', [AuthController::class, 'regProc'])->name('auth.regProc');

Route::get('/login', [AuthController::class, 'showLogin'])->name('auth.login');
Route::post('/login', [AuthController::class, 'LoginProced'])->name('auth.loginProc');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/apps', [AppController::class, 'index'])->name('apps.index');
    Route::get('/apps/create', [AppController::class, 'showCreateForm'])->name('apps.create');
    Route::post('/apps', [AppController::class, 'create'])->name('apps.stores');
    Route::patch('/apps/{id}/status', [AppController::class, 'changeStatus'])->name('apps.status');
});
