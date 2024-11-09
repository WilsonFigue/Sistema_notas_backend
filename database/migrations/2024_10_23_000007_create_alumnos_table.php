<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnos', function (Blueprint $table) {
            $table->bigIncrements('id_alumno'); 
            $table->string('nombre_alumno', 30); 
            $table->string('apellido_alumno', 60); 
            $table->date('fecha_nacimiento'); 
            $table->string('genero_alumno', 10); 
            $table->string('direccion_alumno', 120); 
            $table->string('telefono_alumno', 9); 
            $table->string('correo_alumno', 60);
            $table->dateTime('fecha_ingreso'); 
            $table->boolean('estado_alumno'); 
            $table->string('observaciones_alumn', 225)->nullable(); 
            $table->string('foto_alumnos', 60)->nullable(); 
            $table->unsignedBigInteger('id_encargado'); 
            $table->unsignedBigInteger('id_seccion');
            $table->unsignedBigInteger('id_grado'); 
            $table->foreign('id_encargado')->references('id_encargado')->on('encargados')->onDelete('cascade');
            $table->foreign('id_seccion')->references('id_seccion')->on('secciones')->onDelete('cascade');
            $table->foreign('id_grado')->references('id_grado')->on('grados')->onDelete('cascade');
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
        Schema::dropIfExists('alumnos');
    }
}
