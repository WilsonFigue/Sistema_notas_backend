<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocentesTable extends Migration
{
    public function up()
    {
        Schema::create('docentes', function (Blueprint $table) {
            $table->bigIncrements('id_docente'); 
            $table->string('nombre_docente', 30);
            $table->string('apellido_docente', 60);
            $table->string('correo_docente', 60);
            $table->string('especialidad', 25);
            $table->string('telefono_docente', 9);
            $table->string('direccion_docente', 120);
            $table->string('observaciones_docen', 225)->nullable();
            $table->unsignedBigInteger('id_user')->nullable();
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('set null');
            $table->timestamps(); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('docentes');
    }
}

