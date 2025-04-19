<?php

namespace App\Http\Controllers;

use App\Models\Amenity;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class AmenityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $amenities = Amenity::all();
        return response()->json($amenities);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $amenity = Amenity::create($request->all());
        return response()->json($amenity, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Amenity $amenity): JsonResponse
    {
        return response()->json($amenity);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Amenity $amenity): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'icon' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $amenity->update($request->all());
        return response()->json($amenity);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Amenity $amenity): JsonResponse
    {
        $amenity->delete();
        return response()->json(null, 204);
    }
}
