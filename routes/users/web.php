<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\CarreraController;
use App\Http\Controllers\CoordinadorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('auth.login');
});


Route::resource('usuario', UserController::class)->middleware('auth');
Route::resource('home', HomeController::class)->middleware('auth');


Auth::routes();


Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');
Route::get('/usuarios', [UserController::class, 'index'])->middleware('auth')->name('usuarios');

Route::prefix(['middleware' => 'auth'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/', [UserController::class, 'index'])->name('usuarios');
    
});