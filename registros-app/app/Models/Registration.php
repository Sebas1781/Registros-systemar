<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $fillable = [
        'user_id',
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'fotografia',
        'curp',
        'calle',
        'manzana',
        'lote',
        'numero',
        'codigo_postal',
        'municipio',
        'seccion_electoral',
        'ocupacion_actual',
        'experiencia',
        'detalle_experiencia',
        'secciones_desarrollarse',
        'por_que_propone',
        'corriente_politica',
    ];

    /**
     * Relación con el usuario que creó el registro
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
