<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;

  class UserTransaction extends Model
 {
    use SoftDeletes;    

    public $table = 'user_transactions';

    public $fillable = [
        'user_id',
        'crypto_id',
        'exchange_id',
        'country_id',
        'type',
        'value',
        'price',
        'usdt',
        'fiat',
        'datetime',
        'payment_type_id'
    ];

    protected $casts = [
        'type' => 'string',
        'value' => 'float',
        'price' => 'float',
        'usdt' => 'float',
        'fiat' => 'float'
    ];

    public static array $rules = [
        'user_id' => 'required|exists:users,id',
        'crypto_id' => 'required|exists:cryptos,id',
        'exchange_id' => 'required|exists:exchanges,id',
        'country_id' => 'required|exists:countries,id',
        'type' => 'required|min:3|max:20',
        'value' => 'required|min:0|max:9999999.99',
        'price' => 'required|min:0|max:9999999.99',
        'usdt' => 'required|min:0|max:99999.99',
        'fiat' => 'required|min:0|max:99999.99',
        'datetime' => 'required|date',
        'payment_type_id' => 'required|exists:payment_types,id'
    ];

    
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

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

    public function payment_type()
    {
        return $this->belongsTo(\App\Models\PaymentType::class);
    }
}
