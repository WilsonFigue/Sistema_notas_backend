<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trimestres extends Model
{

    protected $table = 'trimestres';
    protected $primaryKey = 'id_trimestre';

    protected $fillable = [
        'nombre_trimestre', 
        'fecha_inicio', 
        'fecha_fin', 
        'año_academico_trimes'
    ];
}
