<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encargado extends Model
{
    use HasFactory;

    // Definimos la tabla asociada a este modelo
    protected $table = 'encargados';

    // La clave primaria personalizada de la tabla
    protected $primaryKey = 'id_encargado';

    // Especificamos los campos que pueden ser llenados de forma masiva
    protected $fillable = [
        'nombre_encargado',
        'apellido_encargado',
        'telefono_encargado',
        'email_encargado',
        'direccion_encargado',
        'relacion_estudiante',
        'DUI_encargado'
    ];

    // Si no usas incrementing en la clave primaria
    public $incrementing = true;

    // Si la clave primaria no es un integer
    protected $keyType = 'int';

    // Para habilitar las marcas de tiempo
    public $timestamps = true;
}
