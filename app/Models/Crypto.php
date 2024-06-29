<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 
 class Crypto extends Model
 {
    use SoftDeletes;    

    public $table = 'cryptos';

    public $fillable = [
        'name',
        'logo'
    ];

    protected $casts = [
        'name' => 'string',
        'logo' => 'string'
    ];

    public static array $rules = [
        'name' => 'required|min:3|max:20',
        'logo' => 'required|min:3|max:100'
    ];

    
}
