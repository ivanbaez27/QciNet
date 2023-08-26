<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\CarreraController;
use App\Http\Controllers\CoordinadorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PublicacionController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\Auth\RegisterController;
use App\Models\Publicacion;
use Spatie\Permission\Models\Role;

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
    if(Auth::user())
    {
        $publicaciones = Publicacion::all();
        $user = Auth::user();
        $roles = Role::all();
       return redirect('home')->with(['publicaciones'=> $publicaciones, 'id_carrera' => $user->id_carrera, 'roles' => $roles]);
    } 
    else{
        return view('auth.login');
    }
});

Route::resource('carrera', CarreraController::class)->middleware('auth');

//Route::resource('coordinador', CoordinadorController::class)->middleware('auth');
Route::resource('estudiante', EstudianteController::class)->middleware('auth');
Route::resource('usuario', UserController::class)->middleware('auth');
Route::resource('registro', RegisterController::class)->middleware('auth');
Route::resource('publicacion', PublicacionController::class)->middleware('auth');

Route::resource('comentario', ComentarioController::class)->middleware('auth');
//Route::resource('home', HomeController::class)->middleware('auth');





Auth::routes();


Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');
//Route::get('/principal', [HomeController::class, 'show'])->middleware('auth')->name('principal');
Route::get('/carreras', [CarreraController::class, 'index'])->middleware('auth')->name('carreras');
Route::get('/usuarios', [UserController::class, 'index'])->middleware('auth')->name('usuarios');
Route::post('/register/role', [RegisterController::class, 'selectRole'])->name('role');
Route::post('/verification', [RegisterController::class, 'verification'])->name('verification');
Route::patch('/index/{user}', [RegisterController::class, 'storeRole'])->name('role.store');
Route::resource('/publicacion', PublicacionController::class)->middleware('auth')->names('publicacion');
Route::post('/publicacion/createPost', [PublicacionController::class, 'createPost'])->middleware('auth')->name('create');
Route::post('/publicacion/editPost', [PublicacionController::class, 'editPost'])->middleware('auth')->name('edit');
Route::get('/delete-post/{id}', [PublicacionController::class, 'getDeletePost'])->middleware('auth')->name('publicacion.delete');
Route::post('/like', [PublicacionController::class, 'postLikePost'])->middleware('auth')->name('like');
Route::resource('/comentario', ComentarioController::class)->middleware('auth')->names('comentario');






Route::prefix(['middleware' => 'auth'], function () {
    Route::get('/', [HomeController::class, 'show'])->name('principal');
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/', [CarreraController::class, 'index'])->name('carreras');
    Route::get('/', [UserController::class, 'index'])->name('usuarios');
    Route::get('/', [PublicacionController::class, 'index'])->name('publicacion');
    
});