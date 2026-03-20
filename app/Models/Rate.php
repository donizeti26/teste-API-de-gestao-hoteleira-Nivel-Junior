<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $fillable = ['external_id',
        'hotel_id',
        'name',
        'price',
        'active'];
}
