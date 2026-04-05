<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        $properties = Property::with(['agent', 'images'])
            ->filter($request->only(['search', 'min_price', 'max_price', 'type', 'bedrooms', 'location']))
            ->latest()
            ->paginate(12);

        return view('properties.index', compact('properties'));
    }

    public function show(Property $property)
    {
        $property->load(['agent', 'images']);
        return view('properties.show', compact('property'));
    }

    public function create()
    {
        // Only agents can create properties
        if (auth()->user()->role !== 'agent') {
            return redirect()->route('dashboard')->with('error', 'Only agents can list properties.');
        }
        return view('properties.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'location' => 'required|string|max:255',
            'property_type' => 'required|string',
            'bedrooms' => 'required|integer|min:0',
            'bathrooms' => 'required|integer|min:0',
            'area' => 'required|integer|min:0',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $property = auth()->user()->properties()->create($validated);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('properties', 'public');
                $property->images()->create([
                    'image_path' => $path,
                    'is_main' => $index === 0,
                ]);
            }
        }

        return redirect()->route('properties.show', $property->slug)->with('success', 'Property listed successfully!');
    }
}
