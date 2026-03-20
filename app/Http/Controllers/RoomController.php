<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    // READ
    public function index()
    {
        return Room::all();
    }

    // READ
    public function show($id)
    {
        return Room::findOrFail($id);
    }

    // CREATE
    public function store(Request $request)
    {
        $room = Room::create([
            'hotel_id' => $request->hotel_id,
            'name' => $request->name,
            'inventory_count' => $request->inventory_count,
        ]);

        return response()->json($room, 201);
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $room = Room::findOrFail($id);

        $room->update([
            'hotel_id' => $request->hotel_id,
            'name' => $request->name,
            'inventory_count' => $request->inventory_count,
        ]);

        return response()->json($room);
    }

    // DELET
    public function destroy($id)
    {
        Room::destroy($id);

        return response()->json([
            'message' => 'Quarto deletado com sucesso'
        ]);
    }
}
