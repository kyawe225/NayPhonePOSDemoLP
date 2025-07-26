<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table="cart";
    protected $guarded = [];
    protected $keyType = 'string';

    public function phones(){
        $this->belongsTo(Phone::class);
    }
}
