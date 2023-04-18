<!DOCTYPE html>
<html>
    <head>
        <title>login</title>
    </head>
    <body>
        <form method="POST" action="{{ route('inicia-sesion') }}" >
            @csrf
            username/email
            <input type="text" name="email" id="">
            @error('email')
            <span>{{ $message }}</span>
            @enderror
            password
            <input type="password" name="password" id="">
            @error('password')
            <span>{{ $message }}</span>
            @enderror
            <button type="submit" >Acceder</button>
            @error('message')
            <span>{{ $message }}</span>
            @enderror
        </form>
        <div class="mt-4">
            <div class="d-flex justify-content-center links">
                no tienes cuenta? <a href="{{route('registro')}}" class="ml-2">Regístrate</a>
            </div>
        </div>
    </body>
</html>
