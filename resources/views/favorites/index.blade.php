<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Favorite Properties') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($favorites->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($favorites as $property)
                        <x-property-card :property="$property" />
                    @endforeach
                </div>
                <div class="mt-8">
                    {{ $favorites->links() }}
                </div>
            @else
                <div class="bg-white p-12 text-center rounded-lg shadow-sm border border-gray-100">
                    <svg class="mx-auto h-16 w-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.318L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                    <h3 class="mt-4 text-xl font-bold text-gray-900">Your favorites list is empty</h3>
                    <p class="mt-2 text-gray-500 max-w-xs mx-auto">Save properties you love to view them later. Start exploring our listings to find your dream home.</p>
                    <a href="{{ route('properties.index') }}" class="mt-8 inline-flex items-center px-6 py-3 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 transition-colors shadow-lg shadow-blue-100">
                        Browse Properties
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
