<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotasTable extends Migration
{
    public function up()
    {
        Schema::create('notas', function (Blueprint $table) {
            $table->bigIncrements('id_nota'); 
            $table->decimal('nota', 5, 2);
            $table->string('observaciones_not', 225);
            $table->string('id_alumno'); 
            $table->unsignedBigInteger('id_asignacion'); 
            $table->unsignedBigInteger('id_trimestre'); 
            $table->foreign('id_alumno')->references('id_alumno')->on('alumnos')->onDelete('cascade');
            $table->foreign('id_asignacion')->references('id_asignacion')->on('asignaciones')->onDelete('cascade');
            $table->foreign('id_trimestre')->references('id_trimestre')->on('trimestres')->onDelete('cascade');
            $table->timestamps(); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('notas');
    }
}

