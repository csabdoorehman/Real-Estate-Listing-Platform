<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                <!-- Image Gallery -->
                <div class="relative h-96 bg-gray-900">
                    @if($property->images->count() > 0)
                        <img src="{{ asset('storage/' . ($property->images->where('is_main', true)->first()->image_path ?? $property->images->first()->image_path)) }}" alt="{{ $property->title }}" class="w-full h-full object-contain">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-white">
                            No Images Available
                        </div>
                    @endif
                </div>

                <div class="p-8 grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Main Content -->
                    <div class="lg:col-span-2">
                        <div class="flex justify-between items-start mb-6">
                            <div>
                                <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $property->title }}</h1>
                                <p class="text-gray-500 flex items-center text-lg">
                                    <svg class="h-5 w-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    {{ $property->location }}
                                </p>
                            </div>
                            <div class="text-right">
                                <span class="text-4xl font-extrabold text-blue-700">${{ number_format($property->price) }}</span>
                                <div class="mt-2 flex space-x-2 justify-end">
                                    <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded uppercase">{{ $property->property_type }}</span>
                                    <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded uppercase">{{ $property->status }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Amenities -->
                        <div class="grid grid-cols-3 gap-4 py-6 border-y border-gray-100 mb-8">
                            <div class="text-center">
                                <span class="block text-2xl font-bold text-gray-900">{{ $property->bedrooms }}</span>
                                <span class="text-gray-500 text-sm uppercase">Bedrooms</span>
                            </div>
                            <div class="text-center">
                                <span class="block text-2xl font-bold text-gray-900">{{ $property->bathrooms }}</span>
                                <span class="text-gray-500 text-sm uppercase">Bathrooms</span>
                            </div>
                            <div class="text-center">
                                <span class="block text-2xl font-bold text-gray-900">{{ number_format($property->area) }}</span>
                                <span class="text-gray-500 text-sm uppercase">Sq Ft</span>
                            </div>
                        </div>

                        <div class="prose max-w-none text-gray-700 mb-10">
                            <h2 class="text-xl font-bold text-gray-900 mb-4">Description</h2>
                            {!! nl2br(e($property->description)) !!}
                        </div>

                        <!-- Map Section -->
                        <div class="mb-10">
                            <h2 class="text-xl font-bold text-gray-900 mb-4">Location</h2>
                            <div class="h-64 bg-gray-100 rounded-lg flex items-center justify-center border border-gray-200">
                                <div class="text-center">
                                    <svg class="mx-auto h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                                    </svg>
                                    <span class="mt-2 block text-gray-500">Google Maps Integration (Stub)</span>
                                    <p class="text-xs text-gray-400 px-10 mt-1 italic text-wrap">Note: To enable live maps, provide a Google Maps API Key in .env as GOOGLE_MAPS_API_KEY</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="space-y-8">
                        <!-- Agent Info -->
                        <div class="bg-gray-50 p-6 rounded-xl border border-gray-100">
                            <h3 class="font-bold text-gray-900 mb-4">Listed By</h3>
                            <div class="flex items-center space-x-4 mb-6">
                                @if($property->agent->profile_image)
                                    <img src="{{ asset('storage/' . $property->agent->profile_image) }}" alt="{{ $property->agent->name }}" class="h-16 w-16 rounded-full border-2 border-white shadow-sm">
                                @else
                                    <div class="h-16 w-16 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-xl uppercase">
                                        {{ substr($property->agent->name, 0, 1) }}
                                    </div>
                                @endif
                                <div>
                                    <h4 class="font-bold text-lg text-gray-900 leading-tight">{{ $property->agent->name }}</h4>
                                    <p class="text-blue-600 text-sm font-medium">Verified Agent</p>
                                </div>
                            </div>
                            <div class="space-y-3">
                                <a href="tel:{{ $property->agent->phone }}" class="w-full flex justify-center items-center px-4 py-2 border border-blue-600 text-blue-600 font-bold rounded-lg hover:bg-blue-50 transition-colors">
                                    Call Me
                                </a>
                                <a href="mailto:{{ $property->agent->email }}" class="w-full flex justify-center items-center px-4 py-2 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 shadow-md shadow-blue-200 transition-colors">
                                    Email Message
                                </a>
                                <a href="{{ route('agents.show', $property->agent->id) }}" class="block text-center text-sm text-gray-500 hover:text-blue-600 underline underline-offset-4">
                                    View Agent Profile
                                </a>
                            </div>
                        </div>

                        <!-- Mortgage Calculator -->
                        <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm" x-data="{
                            price: {{ $property->price }},
                            downPayment: {{ $property->price * 0.2 }},
                            interest: 4.5,
                            years: 30,
                            calculate() {
                                const p = this.price - this.downPayment;
                                const r = (this.interest / 100) / 12;
                                const n = this.years * 12;
                                if (r === 0) return (p / n).toFixed(2);
                                const monthly = (p * (r * Math.pow(1 + r, n))) / (Math.pow(1 + r, n) - 1);
                                return monthly.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2});
                            }
                        }">
                            <h3 class="font-bold text-gray-900 mb-4 flex items-center">
                                <svg class="h-5 w-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                                Mortgage Calculator
                            </h3>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Down Payment ($)</label>
                                    <input type="number" x-model="downPayment" class="w-full border-gray-300 rounded-lg text-sm bg-gray-50 focus:bg-white focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Interest Rate (%)</label>
                                    <input type="number" step="0.1" x-model="interest" class="w-full border-gray-300 rounded-lg text-sm bg-gray-50 focus:bg-white focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Loan Term (Years)</label>
                                    <select x-model="years" class="w-full border-gray-300 rounded-lg text-sm bg-gray-50 focus:bg-white focus:ring-blue-500 focus:border-blue-500">
                                        <option value="15">15 Years</option>
                                        <option value="20">20 Years</option>
                                        <option value="30">30 Years</option>
                                    </select>
                                </div>
                                <div class="bg-blue-50 p-4 rounded-lg border border-blue-100 mt-6 text-center">
                                    <p class="text-blue-600 text-xs font-bold uppercase mb-1">Est. Monthly Payment</p>
                                    <p class="text-2xl font-black text-blue-900">$<span x-text="calculate()"></span></p>
                                </div>
                            </div>
                        </div>

                        <!-- Favorite Toggle -->
                        @auth
                        <form action="{{ route('favorites.toggle', $property->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full flex justify-center items-center space-x-2 px-4 py-3 border-2 border-red-500 text-red-500 font-bold rounded-xl hover:bg-red-50 transition-colors">
                                @if(auth()->user()->favorites->contains($property->id))
                                    <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                                    <span>Remove from Favorites</span>
                                @else
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.318L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                                    <span>Save to Favorites</span>
                                @endif
                            </button>
                        </form>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
