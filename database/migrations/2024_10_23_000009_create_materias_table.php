<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMateriasTable extends Migration
{
    public function up()
    {
        Schema::create('materias', function (Blueprint $table) {
            $table->bigIncrements('id_materia'); 
            $table->string('nombre_materia', 30);
            $table->string('descripcion_mate', 225)->nullable(); 
            $table->unsignedTinyInteger('horas_semanales'); 
            $table->timestamps(); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('materias');
    }
}
