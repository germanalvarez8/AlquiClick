<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }

    public function index(Request $request)
    {
        $query = Room::with('building')->where('is_available', true);

        if ($request->has('building_id')) {
            $query->where('building_id', $request->building_id);
        }

        if ($request->has('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->has('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        if ($request->has('bed_count')) {
            $query->where('bed_count', $request->bed_count);
        }

        if ($request->has('amenities')) {
            $amenities = explode(',', $request->amenities);
            foreach ($amenities as $amenity) {
                $query->whereJsonContains('amenities', $amenity);
            }
        }

        return response()->json($query->get());
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'building_id' => 'required|exists:buildings,id',
            'room_number' => 'required|string|max:10',
            'bed_count' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'owner_email' => 'required|email',
            'owner_phone' => 'required|string',
            'owner_whatsapp' => 'nullable|string',
            'amenities' => 'nullable|array',
            'amenities.*' => 'string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $room = Room::create($validator->validated());

        return response()->json($room, 201);
    }

    public function show(Room $room)
    {
        return response()->json($room->load('building'));
    }

    public function update(Request $request, Room $room)
    {
        $validator = Validator::make($request->all(), [
            'building_id' => 'sometimes|required|exists:buildings,id',
            'room_number' => 'sometimes|required|string|max:10',
            'bed_count' => 'sometimes|required|integer|min:1',
            'price' => 'sometimes|required|numeric|min:0',
            'description' => 'sometimes|required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'owner_email' => 'sometimes|required|email',
            'owner_phone' => 'sometimes|required|string',
            'owner_whatsapp' => 'nullable|string',
            'amenities' => 'nullable|array',
            'amenities.*' => 'string',
            'is_available' => 'sometimes|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $room->update($validator->validated());

        return response()->json($room);
    }

    public function destroy(Room $room)
    {
        $room->delete();
        return response()->json(null, 204);
    }
} 