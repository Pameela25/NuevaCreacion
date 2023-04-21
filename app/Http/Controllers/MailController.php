<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;
//use Mail;

class MailController extends Controller
{
    public function getMail(){
        $data = ['name' => 'Pamela'];
        Mail:: to('pameela.c25@gmail.com')-> send(new TestMail($data));
    }
    //enviar los correo
    public function sendEmail(){
        $details=[
            'tilte' => 'Correo'
        ];
    }
    
    public function sendVerificationEmail(User $user)
    {
        $emailVerificationToken = hash_hmac('sha256', Str::random(40), config('app.key'));
        $user->email_verification_token = $emailVerificationToken;
        $user->save();

        Mail::to($user->email)->send(new VerificationEmail($user));

        return back()->with('success', 'Se ha enviado un correo electrónico de verificación a tu dirección de correo electrónico. Por favor, verifica tu correo electrónico para continuar.');
    }
}
