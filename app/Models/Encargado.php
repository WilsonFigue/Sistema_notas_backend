<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encargado extends Model
{
    use HasFactory;

    protected $table = 'encargados';

    protected $primaryKey = 'id_encargado';

    protected $fillable = [
        'nombre_encargado',
        'apellido_encargado',
        'telefono_encargado',
        'correo_encargado',
        'direccion_encargado',
        'relacion_estudiante',
        'DUI_encargado'
    ];
    public $incrementing = true;

    protected $keyType = 'int';
    public $timestamps = true;
}
