<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $table="phones";
    protected $guarded = [];
    protected $keyType = 'string';
}
