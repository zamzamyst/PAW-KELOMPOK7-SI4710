<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Tracking') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-2">Tracking - {{ $tracking->id }}</h1>
                <hr class="mb-6" />

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Tracking ID</label>
                        <input type="text" class="form-input w-full" value="{{ $tracking->id }}" readonly>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Delivery ID</label>
                        <input type="text" class="form-input w-full" value="{{ $tracking->delivery_id }}" readonly>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Order ID</label>
                        <input type="text" class="form-input w-full" value="{{ $tracking->delivery->order_id ?? '-' }}" readonly>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Menu Name</label>
                        <input type="text" class="form-input w-full" value="{{ $tracking->delivery->order->name ?? '-' }}" readonly>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div class="md:col-span-2">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Coordinates</label>
                        <input type="text" class="form-input w-full bg-blue-50 font-mono text-lg" value="{{ $tracking->formatted_coordinates }}" readonly>
                        <p class="text-sm text-gray-500 mt-1">Latitude: {{ $tracking->latitude }} | Longitude: {{ $tracking->longitude }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Created At</label>
                        <input type="text" class="form-input w-full" value="{{ $tracking->created_at }}" readonly>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Updated At</label>
                        <input type="text" class="form-input w-full" value="{{ $tracking->updated_at }}" readonly>
                    </div>
                </div>

                <hr class="my-6">

                <!-- Delivery Section -->
                @if($tracking->delivery)
                <div class="p-4 bg-blue-50 rounded">
                    <h4 class="font-bold text-blue-800 mb-2">Delivery Information</h4>
                    <p class="text-gray-700 mb-2">Status: 
                        <span class="px-2 py-1 rounded text-white text-xs {{ $tracking->delivery->status_badge }}">
                            {{ $tracking->delivery->formatted_status }}
                        </span>
                    </p>
                    <p class="text-gray-700 mb-3">Address: {{ Str::limit($tracking->delivery->delivery_address, 50) }}</p>
                    <a href="{{ route('delivery.show', $tracking->delivery->id) }}" 
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-sm inline-block">
                        View Delivery Details
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>