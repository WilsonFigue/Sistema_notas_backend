<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notas extends Model
{
    use HasFactory;

    protected $table = 'notas';
    protected $primaryKey = 'id_nota';

    protected $fillable = [
        'nota_1',
        'nota_2',
        'nota_3',
        'observaciones_not',
        'id_alumno',
        'id_asignacion',
        'id_trimestre',
    ];

    public function alumno()
    {
        return $this->belongsTo(Alumnos::class, 'id_alumno');
    }

    public function asignacion()
    {
        return $this->belongsTo(Asignaciones::class, 'id_asignacion');
    }

    public function trimestre()
    {
        return $this->belongsTo(Trimestres::class, 'id_trimestre');
    }
}
