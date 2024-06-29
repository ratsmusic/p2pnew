<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blacklist extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 'sexo', 'nickexchange', 'fecha', 'pais', 'forma_pago', 'numero_referencia', 'numero_orden_exchange', 'descripcion', 'imagen', 'user_id'
    ];
}

