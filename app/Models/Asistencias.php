<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asistencias extends Model
{
    protected $table = 'asistencias';

    protected $primaryKey = 'id_asistencia';

    protected $fillable = [
        'id_alumno',
        'id_asignacion',
        'fecha_asistencia',
        'asistencia',
        'observaciones',
    ];

    public function alumno()
    {
        return $this->belongsTo(Alumnos::class, 'id_alumno');
    }

    public function asignacion()
    {
        return $this->belongsTo(Asignaciones::class, 'id_asignacion');
    }
}
