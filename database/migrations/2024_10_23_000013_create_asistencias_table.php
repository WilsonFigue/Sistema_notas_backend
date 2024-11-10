<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsistenciasTable extends Migration
{
    public function up()
    {
        Schema::create('asistencias', function (Blueprint $table) {
            $table->bigIncrements('id_asistencia'); 
            $table->unsignedBigInteger('id_alumno'); 
            $table->unsignedBigInteger('id_asignacion'); 
            $table->date('fecha_asistencia'); 
            $table->boolean('asistencia'); 
            $table->string('observaciones', 225)->nullable(); 
            $table->foreign('id_alumno')->references('id_alumno')->on('alumnos')->onDelete('cascade');
            $table->foreign('id_asignacion')->references('id_asignacion')->on('asignaciones')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('asistencias');
    }
}
