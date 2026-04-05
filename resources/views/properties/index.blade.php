<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Find Your Dream Property') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Search & Filter Section -->
            <div class="bg-white p-6 rounded-lg shadow-sm mb-8 border border-gray-100">
                <form action="{{ route('properties.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-4">
                    <div class="lg:col-span-2">
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                        <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Location, Title..." class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Type</label>
                        <select name="type" id="type" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">All Types</option>
                            <option value="apartment" {{ request('type') == 'apartment' ? 'selected' : '' }}>Apartment</option>
                            <option value="house" {{ request('type') == 'house' ? 'selected' : '' }}>House</option>
                            <option value="villa" {{ request('type') == 'villa' ? 'selected' : '' }}>Villa</option>
                            <option value="condo" {{ request('type') == 'condo' ? 'selected' : '' }}>Condo</option>
                        </select>
                    </div>

                    <div>
                        <label for="min_price" class="block text-sm font-medium text-gray-700 mb-1">Min Price</label>
                        <input type="number" name="min_price" id="min_price" value="{{ request('min_price') }}" placeholder="Min" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="max_price" class="block text-sm font-medium text-gray-700 mb-1">Max Price</label>
                        <input type="number" name="max_price" id="max_price" value="{{ request('max_price') }}" placeholder="Max" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div class="flex items-end">
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition-colors duration-200">
                            Search
                        </button>
                    </div>
                </form>
            </div>

            <!-- Properties Grid -->
            @if($properties->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($properties as $property)
                        <x-property-card :property="$property" />
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $properties->appends(request()->query())->links() }}
                </div>
            @else
                <div class="bg-white p-12 text-center rounded-lg shadow-sm border border-gray-100">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 9.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">No properties found</h3>
                    <p class="mt-2 text-gray-500">Try adjusting your filters to find what you're looking for.</p>
                    <a href="{{ route('properties.index') }}" class="mt-6 inline-flex items-center text-blue-600 hover:text-blue-500">
                        Clear all filters
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
