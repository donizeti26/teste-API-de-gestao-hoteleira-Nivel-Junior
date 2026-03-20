<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Rate;
use App\Models\Reservation;
use App\Models\Room;

class ImportController extends Controller
{
    public function importHotels()
    {

        $xml = simplexml_load_file(database_path('hotels.xml'));

        foreach ($xml->hotel as $hotel) {
            Hotel::create([
                'external_id' => (int) $hotel['id'],
                'name' => (string) $hotel->name,
            ]);
        }

        return 'Importação concluida';
    }

    public function importRooms()
    {
        $xml = simplexml_load_file(database_path('rooms.xml'));

        foreach ($xml->room as $room) {
            $hotel = Hotel::where('external_id', (int) $room['hotel_id'])->first();

            if (! $hotel) {
                continue;
            }

            Room::create([
                'external_id' => (int) $room['id'],
                'hotel_id' => $hotel->id,
                'name' => (string) $room,
                'inventory_count' => (int) $room['inventory_count'],
            ]);
        }

        return 'Rooms importados';
    }

    public function importRates()
    {
        $xml = simplexml_load_file(database_path('rates.xml'));

        foreach ($xml->rate as $rate) {
            $hotel = Hotel::where('external_id', (int) $rate['hotel_id'])->first();

            if (! $hotel) {
                continue;
            }

            Rate::create([
                'external_id' => (int) $rate['id'],
                'hotel_id' => $hotel->id,
                'name' => (string) $rate,
                'price' => (float) $rate['price'],
                'active' => (bool) $rate['active'],
            ]);
        }

        return 'Rates importados';
    }

    public function ImportReservations()
    {

        $xml = simplexml_load_file(database_path('reservations.xml'));

        foreach ($xml->reservation as $reservation) {

            $hotel = Hotel::where('external_id', (int) $reservation->hotel_id)->first();

            if (! $hotel) {
                continue;
            }
            $room = Room::where('external_id', (int) $reservation->room->id)->first();

            if (! $room) {
                continue;
            }

            Reservation::create([
                'external_id' => (int) $reservation->id,
                'hotel_id' => $hotel->id,
                'room_id' => $room->id,

                'first_name' => (string) $reservation->costumer->first_name,
                'last_name' => (string) $reservation->costumer->last_name,

                'checkin' => (string) $reservation->room->arrival_date,
                'checkout' => (string) $reservation->room->departure_date,

                'total_price' => (float) $reservation->room->total_price,
            ]);
        }

        return 'Reservations importadas';
    }
}
