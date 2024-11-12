<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignaciones extends Model
{
    use HasFactory;

    protected $table = 'asignaciones'; // Si el nombre de la tabla no sigue la convención plural

    protected $primaryKey = 'id_asignacion'; // Si la clave primaria tiene un nombre diferente

    protected $fillable = [
        'año_academico_asig',
        'id_materia',
        'id_grado',
        'id_docente',
    ];

    public function materia()
    {
        return $this->belongsTo(Materias::class, 'id_materia');
    }

    public function grado()
    {
        return $this->belongsTo(Grados::class, 'id_grado');
    }

    public function docente()
    {
        return $this->belongsTo(Docentes::class, 'id_docente');
    }
}
