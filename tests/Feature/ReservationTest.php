<?php

namespace Tests\Feature;

use Tests\TestCase;

class ReservationTest extends TestCase
{
    public function test_create_reservation_success()
    {
        $response = $this->postJson('/api/reservations', [
            'room_id' => 1,
            'hotel_id' => 1,
            'first_name' => 'Doni',
            'last_name' => 'Silva',
            'checkin' => '2026-05-01',
            'checkout' => '2026-05-03',
            'total_price' => 300
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Reserva criada com sucesso'
        ]);
    }

    public function teste_cannot_create_conflicting_reservation()
    {
        $this->postJson('api/reservations', [
            'room_id' => 1,
            'hotel_id' => 1,
            'first_name' => 'Teste',
            'last_name' => 'Um',
            'checkin' => '2026-06-10',
            'checkout' => '2026-06-03',
            'total_price' => 300
        ]);

        $response = $this->postJson('/api/reservations', [
            'room_id' => 1,
            'hotel_id' => 1,
            'first_name' => 'Teste',
            'last_name' => 'Dois',
            'checkin' => '2026-06-02',
            'checkout' => '2026-06-04',
            'total_price' => 300
        ]);


        $response->assertStatus(400);
        $response->assertJson([
            'message' => 'Quarto indisponivel'
        ]);
    }
}
