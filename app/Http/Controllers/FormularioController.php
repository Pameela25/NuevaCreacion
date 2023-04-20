<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Datos;

class FormularioController extends Controller
{
   // Para guardar los datos
   public function guardarDatos(Request $request)
   {
    // Guardar los datos en la base de datos
    // Validar los datos del formulario

    $validatedData = $request->validate([
        'nombre' => 'required',
        'telefono' => 'required',
        'sexo' => 'nullable',
        'telefonoComercial' => 'required',
        'productos' => 'nullable',
        'productosDestacados' => 'nullable'
    ]);

    // Guardar los datos en la base de datos
        $nuevaTabla = new Datos();
        $nuevaTabla->nombre = $request->nombre;
        $nuevaTabla->telefono = $request->telefono;
        $nuevaTabla->sexo = $request->sexo;
        $nuevaTabla->telefonoComercial = $request->telefonoComercial;
        $nuevaTabla->productos = $request->productos;
        $nuevaTabla->productosDestacados = $request->has('productosDestacados') ? $request->productosDestacados : null;

        $nuevaTabla->save();

    // Redirigir al usuario a una página de éxito o mostrar un mensaje de éxito
    return redirect()->route('login')->with('success', 'Los datos se han guardado correctamente.');
    }
}