<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsignacionesTable extends Migration
{
    public function up()
    {
        Schema::create('asignaciones', function (Blueprint $table) {
            $table->bigIncrements('id_asignacion'); 
            $table->date('año_academico_asig'); 
            $table->unsignedBigInteger('id_materia'); 
            $table->unsignedBigInteger('id_grado'); 
            $table->string('id_docente'); 
            $table->foreign('id_materia')->references('id_materia')->on('materias')->onDelete('cascade');
            $table->foreign('id_grado')->references('id_grado')->on('grados')->onDelete('cascade');
            $table->foreign('id_docente')->references('id_docente')->on('docentes')->onDelete('cascade');
            $table->timestamps(); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('asignaciones');
    }
}

