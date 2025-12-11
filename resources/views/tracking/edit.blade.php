<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update Tracking') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('tracking.update', $tracking->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="tracking_id" class="block text-gray-700 font-semibold mb-2">Tracking ID</label>
                        <input type="text" id="tracking_id" value="{{ $tracking->id }}" readonly
                            class="w-full border border-gray-300 rounded px-3 py-2 bg-gray-100" />
                    </div>

                    <div class="mb-4">
                        <label for="delivery_id" class="block text-gray-700 font-semibold mb-2">Delivery ID</label>
                        <input type="text" id="delivery_id" value="{{ $tracking->delivery_id }}" readonly
                            class="w-full border border-gray-300 rounded px-3 py-2 bg-gray-100" />
                    </div>

                    <div class="mb-4">
                        <label for="order_id" class="block text-gray-700 font-semibold mb-2">Order ID</label>
                        <input type="text" id="order_id" value="{{ $tracking->delivery->order_id ?? '-' }}" readonly
                            class="w-full border border-gray-300 rounded px-3 py-2 bg-gray-100" />
                    </div>

                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-semibold mb-2">Menu Name</label>
                        <input type="text" id="name" value="{{ $tracking->delivery->order->name ?? '-' }}" readonly
                            class="w-full border border-gray-300 rounded px-3 py-2 bg-gray-100" />
                    </div>

                    <div class="mb-6 p-4 bg-blue-50 border-l-4 border-blue-500 rounded">
                        <p class="text-gray-700 font-semibold mb-2">Current Coordinates</p>
                        <p class="text-gray-800 text-lg font-mono">{{ $tracking->formatted_coordinates }}</p>
                        <p class="text-gray-600 text-sm mt-2">Click the button below to generate new random coordinates within Indonesia bounds</p>
                    </div>

                    @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded">
                        <ul class="list-disc list-inside text-red-600">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <button type="submit" class="bg-[#881a14] text-white px-4 py-2 rounded hover:bg-[#6f1611]">
                        Generate New Coordinates
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>