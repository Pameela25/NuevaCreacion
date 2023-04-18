<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

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
Route::view('/login',"login")->name('login');
Route::view('/registro',"register")->name('registro');
//Si es una session activa nos deja entrar si las acredenciales son correctas
Route::view('/privada',"secret")->middleware('auth')->name('privada');
//Route::view('/privada',"secret")->name('privada');
Route::post('/validar-registro',[LoginController::class,'register'])->name('validar-registro');
Route::post('/inicia-sesion',[LoginController::class,'login'])->name('inicia-sesion');
Route::get('/logout',[LoginController::class,'logout'])->name('logout');
