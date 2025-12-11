<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Delivery') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if (Session::has('info'))
            <div class="mb-4 font-medium text-sm text-blue-600">
                {{ Session::get('info') }}
            </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Informasi Delivery</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-600 font-semibold">Delivery ID:</p>
                        <p class="text-gray-800">{{ $delivery->id }}</p>
                    </div>

                    <div>
                        <p class="text-gray-600 font-semibold">Order ID:</p>
                        <p class="text-gray-800">{{ $delivery->order_id }}</p>
                    </div>

                    <div>
                        <p class="text-gray-600 font-semibold">Menu Name:</p>
                        <p class="text-gray-800">{{ $delivery->order->name ?? '-' }}</p>
                    </div>

                    <div>
                        <p class="text-gray-600 font-semibold">Quantity:</p>
                        <p class="text-gray-800">{{ $delivery->order->quantity ?? '-' }}</p>
                    </div>

                    <div class="md:col-span-2">
                        <p class="text-gray-600 font-semibold">Alamat Pengiriman:</p>
                        <p class="text-gray-800">{{ $delivery->delivery_address }}</p>
                    </div>

                    <div>
                        <p class="text-gray-600 font-semibold">Status:</p>
                        <span class="inline-block px-3 py-1 rounded text-white text-sm {{ $delivery->status_badge }}">
                            {{ $delivery->formatted_status }}
                        </span>
                    </div>

                    <div>
                        <p class="text-gray-600 font-semibold">Dibuat:</p>
                        <p class="text-gray-800">{{ $delivery->created_at->format('d M Y, H:i') }}</p>
                    </div>

                    <div>
                        <p class="text-gray-600 font-semibold">Diperbarui:</p>
                        <p class="text-gray-800">{{ $delivery->updated_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>

                @if($delivery->tracking)
                <div class="mt-6 p-4 bg-blue-50 rounded">
                    <h4 class="font-bold text-blue-800 mb-2">Informasi Tracking</h4>
                    <p class="text-gray-700">Koordinat: {{ $delivery->tracking->formatted_coordinates }}</p>
                    <a href="{{ route('tracking.show', $delivery->tracking->id) }}" class="text-blue-600 hover:underline">
                        Lihat Detail Tracking
                    </a>
                </div>
                @else
                <div class="mt-6 p-4 bg-yellow-50 rounded">
                    <p class="text-gray-700">Belum ada tracking untuk delivery ini.</p>
                    <a href="{{ route('tracking.create', $delivery->id) }}" class="text-blue-600 hover:underline">
                        Buat Tracking
                    </a>
                </div>
                @endif

                <div class="flex gap-2 mt-6">
                    <a href="{{ route('delivery.edit', $delivery->id) }}"
                        class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                        Edit
                    </a>
                    <a href="{{ route('delivery') }}"
                        class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>