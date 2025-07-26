<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table="sales";
    protected $guarded = [];
    protected $keyType = 'string';

    public function phone(){
        return $this->belongsTo(Phone::class);
    }
}
