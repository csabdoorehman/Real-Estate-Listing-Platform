<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PropertyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'price' => (float) $this->price,
            'location' => $this->location,
            'property_type' => $this->property_type,
            'bedrooms' => $this->bedrooms,
            'bathrooms' => $this->bathrooms,
            'area' => $this->area,
            'status' => $this->status,
            'is_featured' => (bool) $this->is_featured,
            'agent' => [
                'name' => $this->agent->name,
                'email' => $this->agent->email,
                'phone' => $this->agent->phone,
            ],
            'images' => $this->images->map(fn($img) => [
                'url' => asset('storage/' . $img->image_path),
                'is_main' => (bool) $img->is_main,
            ]),
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}
