<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registo</title>
</head>
<body>
    <main>
        <form action="{{route('validar-registro')}}" method="post">            
            @csrf
            <div class="input-group mb-3">
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                </div>
                <input type="text" name="name" class="form-control input_user" value="" placeholder="nombre">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                </div>
                <input type="email" name="email" class="form-control input_user" value="" placeholder="Correo">
            </div>
            <div class="input-group mb-2">
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                </div>
                <input type="password" name="password" class="form-control input_pass" value="" placeholder="contraseña">
            </div>
            <div class="input-group mb-2">
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                </div>
                <input type="password" name="password_confirmation" class="form-control input_pass" value="" placeholder="confirmar contraseña">
            </div>
            
            <div class="d-flex justify-content-center mt-3 login_container">
        <button type="submit" name="button" class="btn btn-primary">Registrar</button>
        </div>
        </form>
        <div class="mt-4">
            <div class="d-flex justify-content-center links">
                ya tienes cuenta? <a href="{{route('login')}}" class="ml-2">Inicia sessión</a>
            </div>
        </div>
    </main>
</body>
</html>