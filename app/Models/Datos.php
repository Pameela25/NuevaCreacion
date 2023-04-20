<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Datos extends Model
{
    protected $table = 'datos';
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'telefono',
        'telefonoComercial',
        'productos',
    ];
      /**
     *Esto es para los atributos opcionales
     * 
     * @var array<int, string>
     */
    protected $guarded = [
        'sexo',
        'productosDestacados',
    ];
}
