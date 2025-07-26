<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Repair extends Model
{
    protected $table="repairs";
    protected $guarded = [];
    protected $keyType = 'string';

    public function service_history(){
        return $this->hasMany(ServiceHistory::class);
    }
    public function customer(){
        return $this->belongsTo(Customer::class);
    }
    
}
