<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página privada</title>
</head>
<body>
    <p>Está accediendo a la sesión privada.</p>
    @auth
        <h1>Bienvenido: {{ Auth::user()->name }}</h1>
        <h2>Rellena el formulario</h2>
        <form method="post" action="{{ route('store-data') }}">
            @csrf
            <label for="nombre">Nombre del cliente:</label>
            <input name="nombre" type="text" class="field-input" required>
            <br>
            <label for="telefono">Número de teléfono del cliente:</label>
            <input name="telefono" type="tel" class="field-input" required>
            <br>
            <label for="sexo">Sexo del comercial:</label>
            <select name="sexo" id="sexo" class="field-input" >
                <option value="">Selecciona una opción</option>
                <option value="Masculino">Masculino</option>
                <option value="Femenino">Femenino</option>
                <option value="Otro">Otro</option>
            </select>
            <br>
            <label for="telefonoComercial">Número de teléfono del comercial:</label>
            <input id="telefonoComercial" name="telefonoComercial" type="tel" class="field-input" required>
            <br>
            <label for="productos">Productos:</label>
            <input id="productos" class="field-input" type="file" name="productos" accept=".txt,.pdf,.csv" required>
            <br>
            <label for="productosDestacados">Productos destacados:</label>
            <input id="productosDestacados" class="field-input" type="file" name="productosDestacados" accept=".txt,.pdf,.csv" multiple>
            <br>
    
            <button class="btn" type="submit">Enviar</button>

        </form>
        <div>
            <a href="{{ route('logout') }}">
                <button type="button">Salir</button>
            </a>
        </div>
    @endauth

    @guest 
        <p>Inicia sesión, estás como invitado.</p>
    @endguest
</body>
</html>
