<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrimestresTable extends Migration
{
    public function up()
    {
        Schema::create('trimestres', function (Blueprint $table) {
            $table->bigIncrements('id_trimestre'); 
            $table->string('nombre_trimestre', 30);
            $table->date('fecha_inicio'); 
            $table->date('fecha_fin'); 
            $table->date('año_academico_trimes'); 

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('trimestres');
    }
}
