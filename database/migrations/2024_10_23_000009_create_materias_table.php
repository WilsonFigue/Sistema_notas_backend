<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


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

        DB::table('materias')->insert([
            ['id_materia' => 1, 'nombre_materia' => 'Matemáticas', 'descripcion_mate' => 'Materia básica de matemáticas', 'horas_semanales' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['id_materia' => 2, 'nombre_materia' => 'Lenguaje', 'descripcion_mate' => 'Materia básica de lenguaje y comunicación', 'horas_semanales' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['id_materia' => 3, 'nombre_materia' => 'Ciencias', 'descripcion_mate' => 'Materia básica de ciencias naturales', 'horas_semanales' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['id_materia' => 4, 'nombre_materia' => 'Sociales', 'descripcion_mate' => 'Materia básica de estudios sociales', 'horas_semanales' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['id_materia' => 5, 'nombre_materia' => 'Física', 'descripcion_mate' => 'Materia básica de física', 'horas_semanales' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['id_materia' => 6, 'nombre_materia' => 'Inglés', 'descripcion_mate' => 'Materia básica de inglés', 'horas_semanales' => 4, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('materias');
    }
}
