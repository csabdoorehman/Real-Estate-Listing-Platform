<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Property extends Model
{
    protected static function booted()
    {
        static::creating(function ($property) {
            $property->slug = Str::slug($property->title);
            
            // Handle duplicate slugs if necessary (basic check)
            $count = static::where('slug', 'like', $property->slug . '%')->count();
            if ($count > 0) {
                $property->slug .= '-' . ($count + 1);
            }
        });
    }
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'description',
        'price',
        'location',
        'property_type',
        'bedrooms',
        'bathrooms',
        'area',
        'is_featured',
        'status',
    ];

    public function agent()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function images()
    {
        return $this->hasMany(PropertyImage::class);
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }

    // Advanced Filtering Scopes
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('title', 'like', '%'.$search.'%')
                    ->orWhere('location', 'like', '%'.$search.'%');
            });
        })->when($filters['min_price'] ?? null, function ($query, $min) {
            $query->where('price', '>=', $min);
        })->when($filters['max_price'] ?? null, function ($query, $max) {
            $query->where('price', '<=', $max);
        })->when($filters['type'] ?? null, function ($query, $type) {
            $query->where('property_type', $type);
        })->when($filters['bedrooms'] ?? null, function ($query, $bedrooms) {
            $query->where('bedrooms', $bedrooms);
        })->when($filters['location'] ?? null, function ($query, $location) {
            $query->where('location', 'like', '%'.$location.'%');
        });
    }
}
