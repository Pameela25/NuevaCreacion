<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\User; //mantiene la informacion
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller{
    //Registra usuario
    public function register(Request $request){
        //validar datos

        $user= new User();
        $user->name=$request->name;
        $user->email=$request->email;
        //contraseñas encriptadas
        $user->password=Hash::make($request->password);
        $user->save();
        
        //enviar correo de confirmación
        
        //Autentificamos por usuario 
        Auth::login($user);
        //redirigimos
        return redirect(route('privada'));
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