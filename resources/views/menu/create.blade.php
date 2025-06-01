<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('menu.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="menu_code" class="block text-gray-700 font-semibold mb-2">Menu Code</label>
                        <input type="text" name="menu_code" id="menu_code" value="{{ old('menu_code') }}" 
                            class="w-full border border-gray-300 rounded px-3 py-2" />
                    </div>

                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-semibold mb-2">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" 
                            class="w-full border border-gray-300 rounded px-3 py-2" />
                    </div>

                    <div class="mb-4">
                        <label for="price" class="block text-gray-700 font-semibold mb-2">Price</label>
                        <input type="number" name="price" id="price" value="{{ old('price') }}" 
                            class="w-full border border-gray-300 rounded px-3 py-2" />
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-gray-700 font-semibold mb-2">Description</label>
                        <textarea name="description" id="description" rows="3"
                            class="w-full border border-gray-300 rounded px-3 py-2">{{ old('description') }}</textarea>
                    </div>

                    <button type="submit" class="bg-[#881a14] text-white px-4 py-2 rounded hover:bg-[#6f1611]">
                        Add Product
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
