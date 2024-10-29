<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Secciones extends Model
{
    use HasFactory;
    protected $table = 'secciones';
    protected $primaryKey = 'id_seccion';
    public $timestamps = true;
    
    protected $fillable = [
        'nombre_seccion',
        'capacidad_seccion'
    ];
}
