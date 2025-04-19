<?php

namespace App\Http\Controllers;

use App\Models\Building;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class BuildingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $buildings = Building::with('activeRooms')->get();
        return response()->json($buildings);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'description' => 'required|string',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $building = Building::create($validator->validated());

        // Generate QR code
        $qrCode = QrCode::size(300)
            ->format('png')
            ->generate(route('buildings.show', $building->id));

        $building->update(['qr_code' => $qrCode]);

        return response()->json($building, 201);
    }

    public function show(Building $building)
    {
        return response()->json($building->load('activeRooms'));
    }

    public function update(Request $request, Building $building)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'address' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'sometimes|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $building->update($validator->validated());

        return response()->json($building);
    }

    public function destroy(Building $building)
    {
        $building->delete();
        return response()->json(null, 204);
    }
} 