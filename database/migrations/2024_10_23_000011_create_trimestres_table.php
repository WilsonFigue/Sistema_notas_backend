<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateTrimestresTable extends Migration
{
    public function up()
    {
        Schema::create('trimestres', function (Blueprint $table) {
            $table->bigIncrements('id_trimestre'); 
            $table->string('nombre_trimestre', 30);
            $table->date('fecha_inicio'); 
            $table->date('fecha_fin'); 
            $table->string('año_academico_trimes'); 
            $table->timestamps();
        });

        DB::table('trimestres')->insert([
            ['id_trimestre' => 1, 'nombre_trimestre' => 'Primer Trimestre', 'fecha_inicio' => '2024-01-01', 'fecha_fin' => '2024-04-30', 'año_academico_trimes' => '2024', 'created_at' => now(), 'updated_at' => now()],
            ['id_trimestre' => 2, 'nombre_trimestre' => 'Segundo Trimestre', 'fecha_inicio' => '2024-05-01', 'fecha_fin' => '2024-08-31', 'año_academico_trimes' => '2024', 'created_at' => now(), 'updated_at' => now()],
            ['id_trimestre' => 3, 'nombre_trimestre' => 'Tercer Trimestre', 'fecha_inicio' => '2024-09-01', 'fecha_fin' => '2024-12-31', 'año_academico_trimes' => '2024', 'created_at' => now(), 'updated_at' => now()]
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('trimestres');
    }
}

