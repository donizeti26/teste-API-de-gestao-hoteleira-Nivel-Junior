<?php

namespace App\Services;

use App\Models\Reservation;

class ReservationService
{
  public function isRoomAvailable($roomId, $checkin, $checkout)
  {
    $conflict = Reservation::where('room_id', $roomId)
      ->where(function ($query) use ($checkin, $checkout) {
        $query->where('checkin', '<', $checkout)
          ->where('checkout', '>', $checkin);
      })
      ->exists();

    return !$conflict;
  }


  public function createReservation($data)
  {
    if (!$this->isRoomAvailable($data['room_id'], $data['checkin'], $data['checkout'])) {
      return null;
    }

    return Reservation::create([
      'external_id' => $data['external_id'],
      'room_id' => $data['room_id'],
      'hotel_id' => $data['hotel_id'],
      'first_name' => $data['first_name'],
      'last_name' => $data['last_name'],
      'checkin' => $data['checkin'],
      'checkout' => $data['checkout'],
      'total_price' => $data['total_price'],

    ]);
  }
}
