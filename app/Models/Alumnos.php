<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumnos extends Model
{
    use HasFactory;
    
    protected $table = 'alumnos';
    protected $primaryKey = 'id_alumno'; 
    public $incrementing = false; 

    protected $fillable = [
        'id_alumno', 
        'nombre_alumno',
        'apellido_alumno',
        'fecha_nacimiento',
        'genero_alumno',
        'direccion_alumno',
        'telefono_alumno',
        'correo_alumno',
        'fecha_ingreso',
        'estado_alumno',
        'observaciones_alumn',
        'foto_alumnos',
        'id_encargado',
        'id_grado',
    ];
}
