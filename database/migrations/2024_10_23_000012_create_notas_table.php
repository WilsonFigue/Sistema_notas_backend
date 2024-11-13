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
            $table->decimal('nota_1', 5, 2)->nullable(); 
            $table->decimal('nota_2', 5, 2)->nullable(); 
            $table->decimal('nota_3', 5, 2)->nullable(); 
            $table->string('observaciones_not', 225)->nullable(); 
            $table->unsignedBigInteger('id_alumno'); 
            $table->unsignedBigInteger('id_asignacion')->nullable();
            $table->unsignedBigInteger('id_trimestre')->nullable();
            $table->foreign('id_alumno')->references('id_alumno')->on('alumnos')->onDelete('cascade');
            $table->foreign('id_asignacion')->references('id_asignacion')->on('asignaciones')->onDelete('set null');
            $table->foreign('id_trimestre')->references('id_trimestre')->on('trimestres')->onDelete('set null');
            $table->timestamps(); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('notas');
    }
}

