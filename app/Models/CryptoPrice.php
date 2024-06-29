<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;

 class CryptoPrice extends Model
 {
     use SoftDeletes;    
     
    public $table = 'crypto_prices';

    public $fillable = [
        'crypto_id',
        'exchange_id',
        'country_id',
        'operator',
        'quantity',
        'price',
        'usdt',
        'fiat',
        'method',
        'type',
        'datetime'
    ];

    protected $casts = [
        'quantity' => 'float',
        'price' => 'float',
        'usdt' => 'float',
        'fiat' => 'float'
    ];

    public static array $rules = [
        'crypto_id' => 'required|exists:cryptos,id',
        'exchange_id' => 'required|exists:exchanges,id',
        'country_id' => 'required|exists:countries,id',
        'operator' => 'required|min:3|max:50',
        'quantity' => 'required|min:0|max:9999999.99',
        'price' => 'required|min:0|max:9999999.99',
        'usdt' => 'required|min:0|max:99999.99',
        'fiat' => 'required|min:0|max:99999.99',
        'method' => 'required|min:3|max:50',
        'type' => 'required|min:3|max:50',
        'datetime' => 'required|date'
    ];

    
    public function crypto()
    {
        return $this->belongsTo(\App\Models\Crypto::class);
    }

    public function exchange()
    {
        return $this->belongsTo(\App\Models\Exchange::class);
    }

    public function country()
    {
        return $this->belongsTo(\App\Models\Country::class);
    }
}
