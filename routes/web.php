<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\FormularioController;
use App\Http\Controllers\MailController;
use App\Mail\VerificacionEmail;

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
/**Envio un correo cualquiera*/
//Route::get('/enviarCorreo',[MailController::class,'getMail'])->name('/enviarCorreo');
/************Pagina inicial */
Route::get('/', function () {
    return view('welcome');
});
/*************************************************Vistas del Login y Register*************/

Route::view('/login',"login")->name('login');
Route::view('/registro',"register")->name('registro');

//Si es una session activa nos deja entrar si las acredenciales son correctas
Route::view('/privada',"secret")->middleware('auth')->name('privada');

//Aqui probamos si podemos entrar a la pagina secreta
//Route::view('/privada',"secret")->name('privada');

Route::post('/validar-registro',[LoginController::class,'register'])->name('validar-registro');
Route::post('/inicia-sesion',[LoginController::class,'login'])->name('inicia-sesion');

//Cierra la sesión activa
Route::get('/logout',[LoginController::class,'logout'])->name('logout');

//Guard el segundo formulario 
Route::post('/store-data', [FormularioController::class, 'guardarDatos'])->name('store-data');

//************************************************Verificacion del correo de verificacion*******/
// Enviar una solicitud de verificación de correo electrónico
/**Route::middleware(['auth'])->group(
    function () {
    Route::get('/email/verify', function () {
    return view('auth.verify-email');
    })->middleware('throttle:6,1')->name('verification.notice');
});
// Verificar correo electronico
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect(route('privada'))->with('status', 'Correo electrónico verificado.');
})->middleware(['CorreoEnviado', 'signed'])->name('verification.verify');

// Reenviar una solicitud de verificación de correo electrónico
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('status', 'Se ha enviado un correo electrónico de verificación.');
})->middleware(['CorreoEnviado', 'throttle:6,1'])->name('verification.send');

/************ Recuperación de contraseña */
/*
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);
    $status = Password::sendResetLink(
        $request->only('email')
    );
    return $status === Password::RESET_LINK_SENT
        ? back()->with('status', __($status))
        : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', function ($token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);
    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->save();
            $user->setRememberToken(Str::random(60));
            event(new PasswordReset($user));
        }
    );
    return $status === Password::PASSWORD_RESET
        ? redirect()->route('login')->with('status', __($status))
        : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');

/************ Formulario de contacto ****//*
Route::get('/contact', [FormularioController::class, 'showContactForm'])->name('contact');
Route::post('/contact', [FormularioController::class, 'sendContact'])->name('contact.send');
*/


/**es la página donde se muestra el mensaje que indica que se debe verificar el correo
 * electrónico para poder acceder a algunas funciones en tu sitio web.*/

 Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware(['auth'])->name('verification.notice');

//es la que se utiliza para marcar el correo electrónico del usuario como verificado una vez que hace clic en el enlace de confirmación en el correo electrónico que recibió.
Route::get('/email/verify/{id}/{hash}', function (Illuminate\Http\Request $request) {
    $request->user()->markEmailAsVerified();
    return redirect('/CorreoEnviado');
})->middleware(['auth', 'signed'])->name('verification.verify');

// se utiliza para enviar un correo electrónico de verificación al usuario que se registró y aún no ha verificado su correo electrónico.
Route::post('/email/verification-notification', function (Illuminate\Http\Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

//se utiliza para enviar el correo electrónico de verificación al usuario, ya que en esta ruta se llama al controlador 
Route::post('/send-verification-email', [MailController::class, 'sendVerificationEmail'])->name('send-verification-email');
