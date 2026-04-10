<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ReservationService;

class ReservationController extends Controller
{
    protected $service;

    public function __construct(ReservationService $service)
    {
        $this->service = $service;
    }

    public function store(Request $request)
    {

        $data = $request->all();

        $reservation = $this->service->createReservation($data);

        if (!$reservation) {
            return response()->json(['message' => 'Quarto indisponivel'], 400);
        }

        return response()->json([
            'message' => 'Reserva criada com sucesso',
            'data' => $reservation
        ], 200);
    }
}
