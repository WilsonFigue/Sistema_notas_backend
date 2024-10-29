<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateGradosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grados', function (Blueprint $table) {
            $table->bigIncrements('id_grado'); 
            $table->string('nombre_grado', 30); 
            $table->unsignedSmallInteger('capacidad_grado'); 
            $table->string('descripcion_grado', 225); 
            $table->timestamps(); 
        });

        DB::table('grados')->insert([
            ['id_grado' => 1, 'nombre_grado' => 'Primero A', 'capacidad_grado' => 30, 'descripcion_grado' => 'Esta sección contará con niños de entre 5 - 7 años. Se enfocará en el desarrollo de habilidades básicas.', 'created_at' => now(), 'updated_at' => now()],
            ['id_grado' => 2, 'nombre_grado' => 'Primero B', 'capacidad_grado' => 30, 'descripcion_grado' => 'Esta sección contará con niños de entre 5 - 7 años. Fomentará la curiosidad y el aprendizaje a través del juego.', 'created_at' => now(), 'updated_at' => now()],
            ['id_grado' => 3, 'nombre_grado' => 'Primero C', 'capacidad_grado' => 30, 'descripcion_grado' => 'Esta sección contará con niños de entre 5 - 7 años. Incluirá actividades artísticas y deportivas.', 'created_at' => now(), 'updated_at' => now()],
            ['id_grado' => 4, 'nombre_grado' => 'Segundo A', 'capacidad_grado' => 30, 'descripcion_grado' => 'Esta sección incluirá niños de 7 - 8 años. Se centrará en el fortalecimiento de la lectura y escritura.', 'created_at' => now(), 'updated_at' => now()],
            ['id_grado' => 5, 'nombre_grado' => 'Segundo B', 'capacidad_grado' => 30, 'descripcion_grado' => 'Esta sección incluirá niños de 7 - 8 años. Trabajará en la comprensión lectora y la resolución de problemas.', 'created_at' => now(), 'updated_at' => now()],
            ['id_grado' => 6, 'nombre_grado' => 'Segundo C', 'capacidad_grado' => 30, 'descripcion_grado' => 'Esta sección incluirá niños de 7 - 8 años. Se enfocará en el aprendizaje colaborativo y actividades grupales.', 'created_at' => now(), 'updated_at' => now()],
            ['id_grado' => 7, 'nombre_grado' => 'Tercero A', 'capacidad_grado' => 30, 'descripcion_grado' => 'Esta sección contará con niños de 8 - 9 años. Se potenciará la creatividad a través de proyectos de arte.', 'created_at' => now(), 'updated_at' => now()],
            ['id_grado' => 8, 'nombre_grado' => 'Tercero B', 'capacidad_grado' => 30, 'descripcion_grado' => 'Esta sección contará con niños de 8 - 9 años. Incluirá la introducción a conceptos matemáticos básicos.', 'created_at' => now(), 'updated_at' => now()],
            ['id_grado' => 9, 'nombre_grado' => 'Tercero C', 'capacidad_grado' => 30, 'descripcion_grado' => 'Esta sección contará con niños de 8 - 9 años. Fomentará el trabajo en equipo a través de actividades grupales.', 'created_at' => now(), 'updated_at' => now()],
            ['id_grado' => 10, 'nombre_grado' => 'Cuarto A', 'capacidad_grado' => 30, 'descripcion_grado' => 'Esta sección incluirá niños de 9 - 10 años. Se enfocará en el pensamiento crítico y análisis de textos.', 'created_at' => now(), 'updated_at' => now()],
            ['id_grado' => 11, 'nombre_grado' => 'Cuarto B', 'capacidad_grado' => 30, 'descripcion_grado' => 'Esta sección incluirá niños de 9 - 10 años. Incluirá el estudio de ciencias básicas y el medio ambiente.', 'created_at' => now(), 'updated_at' => now()],
            ['id_grado' => 12, 'nombre_grado' => 'Cuarto C', 'capacidad_grado' => 30, 'descripcion_grado' => 'Esta sección incluirá niños de 9 - 10 años. Se trabajará en la resolución de problemas matemáticos más complejos.', 'created_at' => now(), 'updated_at' => now()],
            ['id_grado' => 13, 'nombre_grado' => 'Quinto A', 'capacidad_grado' => 30, 'descripcion_grado' => 'Esta sección contará con niños de 10 - 11 años. Se enfocará en el desarrollo de habilidades de investigación.', 'created_at' => now(), 'updated_at' => now()],
            ['id_grado' => 14, 'nombre_grado' => 'Quinto B', 'capacidad_grado' => 30, 'descripcion_grado' => 'Esta sección contará con niños de 10 - 11 años. Incluirá un enfoque en las ciencias sociales y la historia.', 'created_at' => now(), 'updated_at' => now()],
            ['id_grado' => 15, 'nombre_grado' => 'Quinto C', 'capacidad_grado' => 30, 'descripcion_grado' => 'Esta sección contará con niños de 10 - 11 años. Se promoverán actividades de liderazgo y responsabilidad.', 'created_at' => now(), 'updated_at' => now()],
            ['id_grado' => 16, 'nombre_grado' => 'Sexto A', 'capacidad_grado' => 30, 'descripcion_grado' => 'Esta sección incluirá niños de 11 - 12 años. Se centrará en el fortalecimiento de habilidades académicas.', 'created_at' => now(), 'updated_at' => now()],
            ['id_grado' => 17, 'nombre_grado' => 'Sexto B', 'capacidad_grado' => 30, 'descripcion_grado' => 'Esta sección incluirá niños de 11 - 12 años. Se fomentará la creatividad a través de proyectos artísticos.', 'created_at' => now(), 'updated_at' => now()],
            ['id_grado' => 18, 'nombre_grado' => 'Sexto C', 'capacidad_grado' => 30, 'descripcion_grado' => 'Esta sección incluirá niños de 11 - 12 años. Se trabajará en la preparación para la transición a la educación secundaria.', 'created_at' => now(), 'updated_at' => now()],
            ['id_grado' => 19, 'nombre_grado' => 'Septimo A', 'capacidad_grado' => 30, 'descripcion_grado' => 'Esta sección incluirá jóvenes de 12 - 13 años. Se enfocará en la investigación científica y proyectos prácticos.', 'created_at' => now(), 'updated_at' => now()],
            ['id_grado' => 20, 'nombre_grado' => 'Septimo B', 'capacidad_grado' => 30, 'descripcion_grado' => 'Esta sección incluirá jóvenes de 12 - 13 años. Incluirá un enfoque en habilidades de comunicación y debate.', 'created_at' => now(), 'updated_at' => now()],
            ['id_grado' => 21, 'nombre_grado' => 'Septimo C', 'capacidad_grado' => 30, 'descripcion_grado' => 'Esta sección incluirá jóvenes de 12 - 13 años. Se promoverán actividades de voluntariado y responsabilidad social.', 'created_at' => now(), 'updated_at' => now()],
            ['id_grado' => 22, 'nombre_grado' => 'Octavo A', 'capacidad_grado' => 30, 'descripcion_grado' => 'Esta sección incluirá jóvenes de 13 - 14 años. Se trabajará en el desarrollo de habilidades técnicas y digitales.', 'created_at' => now(), 'updated_at' => now()],
            ['id_grado' => 23, 'nombre_grado' => 'Octavo B', 'capacidad_grado' => 30, 'descripcion_grado' => 'Esta sección incluirá jóvenes de 13 - 14 años. Se enfocará en la literatura y la escritura creativa.', 'created_at' => now(), 'updated_at' => now()],
            ['id_grado' => 24, 'nombre_grado' => 'Octavo C', 'capacidad_grado' => 30, 'descripcion_grado' => 'Esta sección incluirá jóvenes de 13 - 14 años. Se fomentará la investigación en ciencias sociales.', 'created_at' => now(), 'updated_at' => now()],
            ['id_grado' => 25, 'nombre_grado' => 'Noveno A', 'capacidad_grado' => 30, 'descripcion_grado' => 'Esta sección incluirá jóvenes de 14 - 15 años. Se trabajará en la preparación para la educación media.', 'created_at' => now(), 'updated_at' => now()],
            ['id_grado' => 26, 'nombre_grado' => 'Noveno B', 'capacidad_grado' => 30, 'descripcion_grado' => 'Esta sección incluirá jóvenes de 14 - 15 años. Se enfocará en el fortalecimiento de la autoestima y habilidades interpersonales.', 'created_at' => now(), 'updated_at' => now()],
            ['id_grado' => 27, 'nombre_grado' => 'Noveno C', 'capacidad_grado' => 30, 'descripcion_grado' => 'Esta sección incluirá jóvenes de 14 - 15 años. Incluirá actividades que promuevan la ciudadanía activa.', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grados');
    }
}
