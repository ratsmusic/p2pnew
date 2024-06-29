<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenCompra extends Model
{
    use HasFactory;

    protected $table = 'ordenes_compra';

    protected $fillable = [
        'pais',
        'fecha_hora',
        'exchange',
        'moneda_comprada',
        'precio_usd_comprado',
        'precio_fiat_comprado',
        'cantidad_fiat_comprado',
        'estatus'
    ];
}
