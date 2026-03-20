<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'external_id',
        'hotel_id',
        'name',
        'inventory_count',
    ];
}
