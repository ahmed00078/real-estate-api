<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        $query = Property::query();

        // Filter by type
        if ($request->has('type')) {
            $query->where('type', $request->input('type'));
        }

        // Filter by address (partial match)
        if ($request->has('address')) {
            $query->where('address', 'LIKE', '%' . $request->input('address') . '%');
        }

        // Filter by size range
        if ($request->has('min_size')) {
            $query->where('size', '>=', $request->input('min_size'));
        }
        if ($request->has('max_size')) {
            $query->where('size', '<=', $request->input('max_size'));
        }

        // Filter by bedrooms
        if ($request->has('bedrooms')) {
            $query->where('bedrooms', $request->input('bedrooms'));
        }

        // Filter by price range
        if ($request->has('min_price')) {
            $query->where('price', '>=', $request->input('min_price'));
        }
        if ($request->has('max_price')) {
            $query->where('price', '<=', $request->input('max_price'));
        }

        return $query->paginate(10);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Property::validationRules());

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $property = Property::create($validator->validated());

        return response()->json($property, 201);
    }

    public function searchByLocation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'radius' => 'sometimes|numeric|min:0|max:100'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $radius = $request->input('radius', 10); // Default 10km
        $properties = Property::searchByLocation(
            $request->input('latitude'), 
            $request->input('longitude'), 
            $radius
        );

        return response()->json($properties);
    }
}