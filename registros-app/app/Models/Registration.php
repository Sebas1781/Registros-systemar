<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $fillable = [
        'nombre',
        'email',
        'telefono',
        'mensaje',
    ];
}
