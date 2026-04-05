<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create an Agent
        $agent = User::create([
            'name' => 'John Doe',
            'email' => 'agent@example.com',
            'password' => Hash::make('password'),
            'role' => 'agent',
            'phone' => '+1 (555) 123-4567',
            'bio' => 'Experienced real estate agent specializing in luxury apartments and suburban family homes. With over 10 years in the industry, I help clients find their perfect living space.',
        ]);

        // Create a Buyer
        User::create([
            'name' => 'Jane Smith',
            'email' => 'buyer@example.com',
            'password' => Hash::make('password'),
            'role' => 'buyer',
            'phone' => '+1 (555) 987-6543',
        ]);

        $properties = [
            [
                'title' => 'Modern Luxury Apartment',
                'description' => 'A stunning modern apartment located in the heart of the city. Features floor-to-ceiling windows, a gourmet kitchen, and a private balcony with panoramic views.',
                'price' => 750000,
                'location' => 'Downtown Metropolis',
                'property_type' => 'apartment',
                'bedrooms' => 2,
                'bathrooms' => 2,
                'area' => 1200,
                'is_featured' => true,
            ],
            [
                'title' => 'Spacious Family House',
                'description' => 'Beautiful 4-bedroom house with a large backyard and swimming pool. Perfect for families looking for a quiet suburban lifestyle.',
                'price' => 1200000,
                'location' => 'Green Valley Suburbs',
                'property_type' => 'house',
                'bedrooms' => 4,
                'bathrooms' => 3,
                'area' => 2800,
                'is_featured' => true,
            ],
            [
                'title' => 'Cozy Beachfront Villa',
                'description' => 'Wake up to the sound of waves in this charming beachfront villa. Private beach access and wrap-around deck included.',
                'price' => 2500000,
                'location' => 'Azure Coast',
                'property_type' => 'villa',
                'bedrooms' => 3,
                'bathrooms' => 3,
                'area' => 2200,
                'is_featured' => false,
            ],
            [
                'title' => 'Chic Urban Condo',
                'description' => 'Stylish condo in a trendy neighborhood. Open-concept living space and high-end finishes throughout.',
                'price' => 450000,
                'location' => 'North End District',
                'property_type' => 'condo',
                'bedrooms' => 1,
                'bathrooms' => 1,
                'area' => 850,
                'is_featured' => false,
            ],
        ];

        foreach ($properties as $pData) {
            $property = $agent->properties()->create($pData);
            
            // Add a few placeholder images for each property (using external placeholder service initially)
            // In a real app, these would be local files in storage/app/public
            // For seeding purposes, we'll use a dummy path and rely on the UI to handle missing files gracefully or use a placeholder
            $property->images()->create([
                'image_path' => 'placeholders/prop-' . $property->id . '.jpg',
                'is_main' => true,
            ]);
        }
    }
}
