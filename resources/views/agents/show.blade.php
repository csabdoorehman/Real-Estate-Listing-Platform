<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Agent Profile: ') }} {{ $agent->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 p-8 mb-8">
                <div class="flex flex-col md:flex-row items-center md:items-start space-y-6 md:space-y-0 md:space-x-8">
                    <div class="flex-shrink-0">
                        @if($agent->profile_image)
                            <img src="{{ asset('storage/' . $agent->profile_image) }}" alt="{{ $agent->name }}" class="h-32 w-32 rounded-full border-4 border-white shadow-lg">
                        @else
                            <div class="h-32 w-32 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-4xl uppercase shadow-inner">
                                {{ substr($agent->name, 0, 1) }}
                            </div>
                        @endif
                    </div>
                    <div class="flex-grow text-center md:text-left">
                        <h1 class="text-3xl font-extrabold text-gray-900 mb-2">{{ $agent->name }}</h1>
                        <p class="text-blue-600 font-bold mb-4 uppercase tracking-widest text-xs">Professional Real Estate Agent</p>
                        
                        <div class="flex flex-wrap justify-center md:justify-start gap-4 mb-6">
                            <span class="flex items-center text-gray-600">
                                <svg class="h-5 w-5 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                {{ $agent->phone ?? 'No phone provided' }}
                            </span>
                            <span class="flex items-center text-gray-600">
                                <svg class="h-5 w-5 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 01-2 2v10a2 2 0 012 2z"></path></svg>
                                {{ $agent->email }}
                            </span>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-xl text-gray-700 italic border-l-4 border-blue-500">
                            {{ $agent->bio ?? 'This agent hasn\'t shared a bio yet.' }}
                        </div>
                    </div>
                    <div class="flex-shrink-0">
                         <div class="bg-blue-600 text-white rounded-xl p-6 text-center shadow-xl shadow-blue-100">
                            <p class="text-xs font-bold uppercase mb-1 opacity-80">Total Listings</p>
                            <p class="text-4xl font-black">{{ $agent->properties->count() }}</p>
                         </div>
                    </div>
                </div>
            </div>

            <h2 class="text-2xl font-bold text-gray-900 mb-6">Properties by {{ $agent->name }}</h2>
            
            @if($properties->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($properties as $property)
                        <x-property-card :property="$property" />
                    @endforeach
                </div>
                <div class="mt-8">
                    {{ $properties->links() }}
                </div>
            @else
                <div class="bg-white p-12 text-center rounded-lg shadow-sm border border-gray-100">
                    <p class="text-gray-500">This agent currently has no active listings.</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
