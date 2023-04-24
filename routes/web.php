<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\FormularioController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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
    return view('welcome');
});

Route::view('/login',"login")->name('login');
Route::view('/registro',"register")->name('registro');
//Si es una session activa nos deja entrar si las acredenciales son correctas
Route::view('/privada',"secret")->middleware('auth')->name('privada');
//Route::view('/privada',"secret")->name('privada');
Route::post('/validar-registro',[LoginController::class,'register'])->name('validar-registro');
Route::post('/inicia-sesion',[LoginController::class,'login'])->name('inicia-sesion');

Route::get('/logout',[LoginController::class,'logout'])->name('logout');

Route::post('/store-data', [FormularioController::class, 'guardarDatos'])->name('store-data');

/**Enviamos la notificacion de verificacion siempre y cuando este verificado */
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');
/**Cuando el usuario haga clic en el enlace de verificación de correo electrónico es decir 
 *  Esta solicitud se encargará automáticamente de validar los parámetros de identificación y hash de la solicitud.*/
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/privada');
})->middleware(['auth', 'signed'])->name('verification.verify');
/**cuando el usuario necesita que se vuelva a enviar el correo electrónico de verificación */
Route::post('/email/verification-notification', function (Illuminate\Http\Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
