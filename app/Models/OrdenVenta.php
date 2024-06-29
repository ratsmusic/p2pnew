<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenVenta extends Model
{
    use HasFactory;

    protected $table = 'ordenes_venta';

    /* protected $fillable = [
        'pais',
        'fecha_hora',
        'exchange',
        'moneda_vendida',
        'precio_usd_vendido',
        'precio_fiat_vendido',
        'cantidad_fiat_vendido',
        'estatus'
    ]; */
    protected $guarded = [];
}
