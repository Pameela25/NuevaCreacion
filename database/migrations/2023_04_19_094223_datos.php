<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('telefono',9);
            $table->enum('sexo', ['Masculino', 'Femenino', 'Otro'])->nullable(); // Add enum field for gender
            $table->string('telefonoComercial',9);
            $table->binary('productos');
            //Permitimos valores nulos, revisar esto xq lo puse manual en la base de datos
            $table->binary('productosDestacados')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('datos');
    }
};
