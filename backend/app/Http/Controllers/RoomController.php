<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Building;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $rooms = Room::with(['building', 'amenities'])->get();
        return response()->json($rooms);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'building_id' => 'required|exists:buildings,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'capacity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'beds' => 'required|integer|min:1',
            'bathrooms' => 'required|integer|min:1',
            'is_available' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $room = Room::create($request->all());
        return response()->json($room, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room): JsonResponse
    {
        $room->load(['building', 'amenities']);
        return response()->json($room);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'building_id' => 'sometimes|required|exists:buildings,id',
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'capacity' => 'sometimes|required|integer|min:1',
            'price' => 'sometimes|required|numeric|min:0',
            'beds' => 'sometimes|required|integer|min:1',
            'bathrooms' => 'sometimes|required|integer|min:1',
            'is_available' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $room->update($request->all());
        return response()->json($room);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room): JsonResponse
    {
        $room->delete();
        return response()->json(null, 204);
    }

    public function getBuildingRooms(Building $building): JsonResponse
    {
        $rooms = $building->rooms()->with('amenities')->get();
        return response()->json($rooms);
    }

    public function syncAmenities(Request $request, Room $room): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'amenities' => 'required|array',
            'amenities.*' => 'exists:amenities,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $room->amenities()->sync($request->amenities);
        return response()->json($room->load('amenities'));
    }
}
