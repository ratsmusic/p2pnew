<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;

  class PaymentType extends Model
 {
    use SoftDeletes;    

    public $table = 'payment_types';

    public $fillable = [
        'name'
    ];

    protected $casts = [
        'name' => 'string'
    ];

    public static array $rules = [
        'name' => 'required|min:3|max:30'
    ];

    
}
