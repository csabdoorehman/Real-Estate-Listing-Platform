<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Http\Resources\PropertyResource;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        $properties = Property::with(['agent', 'images'])
            ->filter($request->only(['search', 'min_price', 'max_price', 'type', 'bedrooms', 'location']))
            ->latest()
            ->paginate(12);

        return PropertyResource::collection($properties);
    }

    public function show(Property $property)
    {
        $property->load(['agent', 'images']);
        return new PropertyResource($property);
    }
}
