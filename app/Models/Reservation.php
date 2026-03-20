<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'external_id',
        'hotel_id',
        'room_id',
        'first_name',
        'last_name',
        'checkin',
        'checkout',
        'total_price',
        'total_guests'
    ];
}
