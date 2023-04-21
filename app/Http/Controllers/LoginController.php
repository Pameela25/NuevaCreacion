<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\User; //mantiene la informacion
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
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
        /* Generar una URL de verificación de correo electrónico firmada dudara 60 min contiene id de usuario y un hash del correo
        El hash se utiliza para proteger la integridad de la URL y asegurarse de que no se haya modificado.*/
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            //durante 60 min
            now()->addMinutes(60),
            [
                'id' => $user->id,
                'hash' => sha1($user->email)
            ]);

        // Enviar un correo electrónico de verificación
        Mail::to($user->email)->send(new VerificationEmail($verificationUrl));

        // Autentificar al usuario
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
    
}

