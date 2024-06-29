<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;

 class Exchange extends Model
 {
     use SoftDeletes;    
     
    public $table = 'exchanges';

    public $fillable = [
        'name',
        'logo'
    ];

    protected $casts = [
        'name' => 'string',
        'logo' => 'string'
    ];

    public static array $rules = [
        'name' => 'required|min:3|max:30',
        'logo' => 'required|min:3|max:100'
    ];

    
}
