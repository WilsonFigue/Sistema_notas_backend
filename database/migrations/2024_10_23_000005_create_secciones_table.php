<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateSeccionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('secciones', function (Blueprint $table) {
            $table->bigIncrements('id_seccion'); 
            $table->string('nombre_seccion', 30); 
            $table->unsignedSmallInteger('capacidad_seccion'); 
            $table->timestamps(); 
        });

        DB::table('secciones')->insert([
            ['id_seccion' => 1, 'nombre_seccion' => 'Primero', 'capacidad_seccion' => 90, 'created_at' => now(), 'updated_at' => now()],
            ['id_seccion' => 3, 'nombre_seccion' => 'Tercero', 'capacidad_seccion' => 90, 'created_at' => now(), 'updated_at' => now()],
            ['id_seccion' => 4, 'nombre_seccion' => 'Cuarto', 'capacidad_seccion' => 90, 'created_at' => now(), 'updated_at' => now()],
            ['id_seccion' => 5, 'nombre_seccion' => 'Quinto', 'capacidad_seccion' => 90, 'created_at' => now(), 'updated_at' => now()],
            ['id_seccion' => 6, 'nombre_seccion' => 'Sexto', 'capacidad_seccion' => 90, 'created_at' => now(), 'updated_at' => now()],
            ['id_seccion' => 7, 'nombre_seccion' => 'Septimo', 'capacidad_seccion' => 90, 'created_at' => now(), 'updated_at' => now()],
            ['id_seccion' => 8, 'nombre_seccion' => 'Octavo', 'capacidad_seccion' => 90, 'created_at' => now(), 'updated_at' => now()],
            ['id_seccion' => 9, 'nombre_seccion' => 'Noveno', 'capacidad_seccion' => 90, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('secciones');
    }
}
