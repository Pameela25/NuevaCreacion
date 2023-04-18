<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina privada</title>
</head>
<body>
    Esta accediendo a la session privada
    <body>
        <h1>hola</h1>
        @auth
        <p>Bienvenido ha acedido {{Auth::user()->name}}</p>
        <h1>Rellena el Formulario</h1>




        <div> <a href="{{route('logout')}}"><button type="button">Salir</button></a></div>
        @endauth

        @guest 
        <p>Inicia sesión, estás como invitado</p>
        @endguest
    </body>
</body>
</html>