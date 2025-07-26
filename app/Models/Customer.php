<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table="customers";
    protected $guarded = [];

    public function sale(){
        return $this->hasMany(Sale::class);
    }

    public function repairs(){
        return $this->hasMany(Repair::class);
    }
}
