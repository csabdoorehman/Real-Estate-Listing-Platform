<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 font-bold text-xl border-b border-gray-100">
                    {{ __("Welcome back, ") }} {{ Auth::user()->name }}!
                </div>
                
                <div class="p-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Global Actions -->
                    <div class="bg-blue-50 p-6 rounded-xl border border-blue-100 hover:shadow-md transition-shadow group">
                        <h3 class="font-bold text-blue-900 mb-2 flex items-center">
                            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            Find Properties
                        </h3>
                        <p class="text-sm text-blue-700 mb-4">Search through thousands of listings to find your match.</p>
                        <a href="{{ route('properties.index') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg font-bold hover:bg-blue-700 transition-colors shadow-sm">
                            Browse Listings
                        </a>
                    </div>

                    @if(Auth::user()->role === 'agent')
                    <!-- Agent Only -->
                    <div class="bg-green-50 p-6 rounded-xl border border-green-100 hover:shadow-md transition-shadow">
                        <h3 class="font-bold text-green-900 mb-2 flex items-center">
                            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            List New Property
                        </h3>
                        <p class="text-sm text-green-700 mb-4">Add your new listing to our global marketplace.</p>
                        <a href="{{ route('properties.create') }}" class="inline-block bg-green-600 text-white px-4 py-2 rounded-lg font-bold hover:bg-green-700 transition-colors shadow-sm">
                            Add Listing
                        </a>
                    </div>

                    <div class="bg-purple-50 p-6 rounded-xl border border-purple-100 hover:shadow-md transition-shadow">
                        <h3 class="font-bold text-purple-900 mb-2 flex items-center">
                            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            Agent Profile
                        </h3>
                        <p class="text-sm text-purple-700 mb-4">Manage your bio, photo, and professional contact info.</p>
                        <a href="{{ route('agent.profile.edit') }}" class="inline-block bg-purple-600 text-white px-4 py-2 rounded-lg font-bold hover:bg-purple-700 transition-colors shadow-sm">
                            Edit Profile
                        </a>
                    </div>
                    @endif

                    <!-- Buyer/General Content -->
                    <div class="bg-red-50 p-6 rounded-xl border border-red-100 hover:shadow-md transition-shadow">
                        <h3 class="font-bold text-red-900 mb-2 flex items-center">
                            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.318L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                            My Favorites
                        </h3>
                        <p class="text-sm text-red-700 mb-4">View and compare the properties you've saved.</p>
                        <a href="{{ route('favorites.index') }}" class="inline-block bg-red-600 text-white px-4 py-2 rounded-lg font-bold hover:bg-red-700 transition-colors shadow-sm">
                            View Saved
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
