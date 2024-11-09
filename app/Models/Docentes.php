<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docentes extends Model
{
    use HasFactory;
    protected $table = 'docentes';
    protected $primaryKey = 'id_docente';
    public $timestamps = true;

    protected $fillable = [
        'nombre_docente',
        'apellido_docente',
        'correo_docente',
        'especialidad',
        'telefono_docente',
        'direccion_docente',
        'observaciones_docen',
        'id_user',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
