@props(['property'])

<div
    class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 hover:shadow-lg transition-shadow duration-300">
    <div class="relative h-48">
        @if($property->images->where('is_main', true)->first())
            <img src="{{ asset('storage/' . $property->images->where('is_main', true)->first()->image_path) }}"
                alt="{{ $property->title }}" class="w-full h-full object-cover">
        @elseif($property->images->first())
            <img src="{{ asset('storage/' . $property->images->first()->image_path) }}" alt="{{ $property->title }}"
                class="w-full h-full object-cover">
        @else
            <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                <span class="text-gray-400">No Image</span>
            </div>
        @endif
        <div class="absolute top-2 right-2 flex space-x-1">
            <span class="bg-blue-600 text-white text-xs font-bold px-2 py-1 rounded">
                {{ ucfirst($property->property_type) }}
            </span>
            <span class="bg-green-600 text-white text-xs font-bold px-2 py-1 rounded">
                {{ ucfirst($property->status) }}
            </span>
        </div>
    </div>

    <div class="p-4">
        <h3 class="font-bold text-lg text-gray-900 truncate mb-1">
            <a href="{{ route('properties.show', $property->slug) }}" class="hover:text-blue-600 transition-colors">
                {{ $property->title }}
            </a>
        </h3>
        <p class="text-gray-500 text-sm flex items-center mb-3">
            <svg class="h-4 w-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            {{ $property->location }}
        </p>

        <div class="flex justify-between items-center mb-4">
            <span class="text-2xl font-bold text-blue-700">${{ number_format($property->price) }}</span>
            <div class="text-gray-500 text-xs flex space-x-3">
                <span class="flex items-center"><span
                        class="font-semibold text-gray-700 mr-1">{{ $property->bedrooms }}</span> Beds</span>
                <span class="flex items-center"><span
                        class="font-semibold text-gray-700 mr-1">{{ $property->bathrooms }}</span> Baths</span>
            </div>
        </div>

        <div class="border-t pt-3 flex justify-between items-center">
            <a href="{{ route('agents.show', $property->agent->id) }}"
                class="text-sm font-medium text-gray-700 flex items-center hover:text-blue-600">
                @if($property->agent->profile_image)
                    <img src="{{ asset('storage/' . $property->agent->profile_image) }}" alt="{{ $property->agent->name }}"
                        class="h-6 w-6 rounded-full mr-2">
                @else
                    <div class="h-6 w-6 rounded-full bg-gray-200 mr-2"></div>
                @endif
                {{ $property->agent->name }}
            </a>

            <form action="{{ route('favorites.toggle', $property->id) }}" method="POST">
                @csrf
                <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors">
                    @auth
                        @if(auth()->user()->favorites->contains($property->id))
                            <svg class="h-6 w-6 text-red-500 fill-current" viewBox="0 0 24 24">
                                <path
                                    d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                            </svg>
                        @else
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.318L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                </path>
                            </svg>
                        @endif
                    @else
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.318L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                            </path>
                        </svg>
                    @endauth
                </button>
            </form>
        </div>
    </div>
</div>