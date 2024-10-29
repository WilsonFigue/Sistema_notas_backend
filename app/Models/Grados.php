<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Grados extends Model
{
    use HasFactory;
    protected $table = 'grados';
    protected $primaryKey = 'id_grado';
    public $timestamps = true;

    protected $fillable = [
        'nombre_grado',
        'capacidad_grado',
        'descripcion_grado',
    ];
}
