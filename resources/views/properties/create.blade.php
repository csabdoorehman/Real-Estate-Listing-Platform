<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('List a New Property') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 p-8">
                <form action="{{ route('properties.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <x-input-label for="title" :value="__('Property Title')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus placeholder="e.g. Modern 3-Bedroom Apartment with City View" />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <div class="md:col-span-2">
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description" rows="4" class="block mt-1 w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm" required placeholder="Describe the property, amenities, and surroundings...">{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="price" :value="__('Price ($)')" />
                            <x-text-input id="price" class="block mt-1 w-full" type="number" name="price" :value="old('price')" required placeholder="0.00" />
                            <x-input-error :messages="$errors->get('price')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="location" :value="__('Location')" />
                            <x-text-input id="location" class="block mt-1 w-full" type="text" name="location" :value="old('location')" required placeholder="City, State, or Address" />
                            <x-input-error :messages="$errors->get('location')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="property_type" :value="__('Property Type')" />
                            <select id="property_type" name="property_type" class="block mt-1 w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm">
                                <option value="apartment">Apartment</option>
                                <option value="house">House</option>
                                <option value="villa">Villa</option>
                                <option value="condo">Condo</option>
                            </select>
                            <x-input-error :messages="$errors->get('property_type')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="area" :value="__('Area (Sq Ft)')" />
                            <x-text-input id="area" class="block mt-1 w-full" type="number" name="area" :value="old('area')" required placeholder="e.g. 1200" />
                            <x-input-error :messages="$errors->get('area')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="bedrooms" :value="__('Bedrooms')" />
                            <x-text-input id="bedrooms" class="block mt-1 w-full" type="number" name="bedrooms" :value="old('bedrooms')" required />
                            <x-input-error :messages="$errors->get('bedrooms')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="bathrooms" :value="__('Bathrooms')" />
                            <x-text-input id="bathrooms" class="block mt-1 w-full" type="number" name="bathrooms" :value="old('bathrooms')" required />
                            <x-input-error :messages="$errors->get('bathrooms')" class="mt-2" />
                        </div>

                        <div class="md:col-span-2">
                            <x-input-label for="images" :value="__('Property Images (Multiple)')" />
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="images" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none">
                                            <span>Upload files</span>
                                            <input id="images" name="images[]" type="file" class="sr-only" multiple accept="image/*">
                                        </label>
                                        <p class="pl-1 text-gray-500 italic">or drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500 italic">PNG, JPG, GIF up to 2MB each</p>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('images')" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <x-primary-button class="ml-4 bg-blue-600 hover:bg-blue-700">
                            {{ __('List Property') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
