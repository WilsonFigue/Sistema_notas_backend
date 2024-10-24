<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEncargadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('encargados', function (Blueprint $table) {
            $table->bigIncrements('id_encargado'); 
            $table->string('name_encargado', 30);
            $table->string('apellido_encargado', 60); 
            $table->string('telefono_encargado', 9);
            $table->string('email_encargado', 60); 
            $table->string('direccion_encargado', 120); 
            $table->string('relacion_estudiante', 20); 
            $table->string('DUI_encargado', 10); 
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
        Schema::dropIfExists('encargados');
    }
}
