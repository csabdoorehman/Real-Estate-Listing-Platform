<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = auth()->user()->favorites()->with(['agent', 'images'])->latest()->paginate(12);
        return view('favorites.index', compact('favorites'));
    }

    public function toggle(Property $property)
    {
        $user = auth()->user();
        
        if ($user->favorites()->where('property_id', $property->id)->exists()) {
            $user->favorites()->detach($property->id);
            $message = 'Removed from favorites.';
        } else {
            $user->favorites()->attach($property->id);
            $message = 'Added to favorites.';
        }

        if (request()->wantsJson()) {
            return response()->json(['message' => $message]);
        }

        return back()->with('success', $message);
    }
}
