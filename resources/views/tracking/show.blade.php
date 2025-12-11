<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Tracking') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if (Session::has('success'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ Session::get('success') }}
            </div>
            @endif

            @if (Session::has('info'))
            <div class="mb-4 font-medium text-sm text-blue-600">
                {{ Session::get('info') }}
            </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Informasi Tracking</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-600 font-semibold">Tracking ID:</p>
                        <p class="text-gray-800">{{ $tracking->id }}</p>
                    </div>

                    <div>
                        <p class="text-gray-600 font-semibold">Delivery ID:</p>
                        <p class="text-gray-800">{{ $tracking->delivery_id }}</p>
                    </div>

                    <div class="md:col-span-2">
                        <p class="text-gray-600 font-semibold">Koordinat Lokasi:</p>
                        <p class="text-gray-800 text-lg font-mono bg-blue-50 p-3 rounded mt-1">{{ $tracking->formatted_coordinates }}</p>
                        <p class="text-sm text-gray-500 mt-1">Latitude: {{ $tracking->latitude }} | Longitude: {{ $tracking->longitude }}</p>
                    </div>

                    <div>
                        <p class="text-gray-600 font-semibold">Dibuat:</p>
                        <p class="text-gray-800">{{ $tracking->created_at->format('d M Y, H:i') }}</p>
                    </div>

                    <div>
                        <p class="text-gray-600 font-semibold">Terakhir Diperbarui:</p>
                        <p class="text-gray-800">{{ $tracking->updated_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>

                <hr class="my-6">

                <h3 class="text-lg font-bold mb-4">Informasi Delivery Terkait</h3>
                
                @if($tracking->delivery)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-4 bg-gray-50 rounded">
                    <div>
                        <p class="text-gray-600 font-semibold">Delivery ID:</p>
                        <p class="text-gray-800">{{ $tracking->delivery->id }}</p>
                    </div>

                    <div>
                        <p class="text-gray-600 font-semibold">Status Delivery:</p>
                        <span class="inline-block px-3 py-1 rounded text-white text-sm {{ $tracking->delivery->status_badge }}">
                            {{ $tracking->delivery->formatted_status }}
                        </span>
                    </div>

                    <div class="md:col-span-2">
                        <p class="text-gray-600 font-semibold">Alamat Pengiriman:</p>
                        <p class="text-gray-800">{{ $tracking->delivery->delivery_address }}</p>
                    </div>

                    <div class="md:col-span-2">
                        <a href="{{ route('delivery.show', $tracking->delivery->id) }}" class="text-blue-600 hover:underline">
                            → Lihat Detail Delivery
                        </a>
                    </div>
                </div>
                @endif

                <hr class="my-6">

                <h3 class="text-lg font-bold mb-4">Informasi Order Terkait</h3>
                
                @if($tracking->delivery && $tracking->delivery->order)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-4 bg-gray-50 rounded">
                    <div>
                        <p class="text-gray-600 font-semibold">Order ID:</p>
                        <p class="text-gray-800">{{ $tracking->delivery->order->id }}</p>
                    </div>

                    <div>
                        <p class="text-gray-600 font-semibold">Menu Code:</p>
                        <p class="text-gray-800">{{ $tracking->delivery->order->menu_code }}</p>
                    </div>

                    <div>
                        <p class="text-gray-600 font-semibold">Menu Name:</p>
                        <p class="text-gray-800">{{ $tracking->delivery->order->name }}</p>
                    </div>

                    <div>
                        <p class="text-gray-600 font-semibold">Harga:</p>
                        <p class="text-gray-800">Rp {{ number_format($tracking->delivery->order->price, 0, ',', '.') }}</p>
                    </div>

                    <div>
                        <p class="text-gray-600 font-semibold">Quantity:</p>
                        <p class="text-gray-800">{{ $tracking->delivery->order->quantity }}</p>
                    </div>

                    <div>
                        <p class="text-gray-600 font-semibold">Total:</p>
                        <p class="text-gray-800 font-bold">Rp {{ number_format($tracking->delivery->order->price * $tracking->delivery->order->quantity, 0, ',', '.') }}</p>
                    </div>

                    @if($tracking->delivery->order->notes)
                    <div class="md:col-span-2">
                        <p class="text-gray-600 font-semibold">Catatan:</p>
                        <p class="text-gray-800">{{ $tracking->delivery->order->notes }}</p>
                    </div>
                    @endif

                    <div class="md:col-span-2">
                        <a href="{{ route('order.show', $tracking->delivery->order->id) }}" class="text-blue-600 hover:underline">
                            → Lihat Detail Order
                        </a>
                    </div>
                </div>
                @endif

                <div class="flex gap-2 mt-6">
                    <a href="{{ route('tracking.edit', $tracking->id) }}"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Update Koordinat
                    </a>
                    <a href="{{ route('tracking') }}"
                        class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                        Kembali ke List
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>