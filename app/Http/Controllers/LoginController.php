<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\User; //mantiene la informacion
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Mail;
use URL;
use App\Mail\VerificacionEmail;


class LoginController extends Controller{
    //Registra usuario
    public function register(Request $request)
    {
        // Validar datos
    
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        
        $user->save();
        
        //enviar correo de confirmación
        $user->sendEmailVerificationNotification();
        //Autentificamos por usuario 
        Auth::login($user);
    
        // Redirigir al usuario a la página privada
        return redirect(route('privada')->with('status', 'Se ha enviado un enlace de verificación a su correo electrónico.'));
    }
    
    public function login(Request $request){
        //validacion

        //Obtenemos usuario y contraseña para contraseña
        $credentials=[
            "email" =>$request->email,
            "password" =>$request->password,
            
        ];

        //mantenemos iniciada 
        $remember=($request->has('remember')?true:false);

        if(Auth::attempt($credentials,$remember)){
            //regenera la session
            $request->session()->regenerate();
            return redirect()->intended(route('privada'));
        }else{
            return redirect('login')->withErrors(['message' => 'Compruebe su usuario y contraseña.']);

        }

    }
    //Para cerrar session, y regresa al login
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('login'));
    }
     /**Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return (new MailMessage)
                ->subject('Verify Email Address')
                ->line('Clickea en el boton ...Click the button below to verify your email address.')
                ->action('Verify Email Address', $url);
        });
    }
}

