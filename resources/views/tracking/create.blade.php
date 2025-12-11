<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Tracking Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Informasi Delivery</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6 p-4 bg-gray-50 rounded">
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
                        <p class="text-gray-600 font-semibold">Alamat Pengiriman:</p>
                        <p class="text-gray-800">{{ Str::limit($delivery->delivery_address, 50) }}</p>
                    </div>

                    <div>
                        <p class="text-gray-600 font-semibold">Status Delivery:</p>
                        <span class="inline-block px-3 py-1 rounded text-white text-sm {{ $delivery->status_badge }}">
                            {{ $delivery->formatted_status }}
                        </span>
                    </div>
                </div>

                <hr class="my-6">

                <h3 class="text-lg font-bold mb-4">Buat Tracking</h3>
                <p class="text-gray-600 mb-4">Koordinat akan dibuat secara otomatis dengan nilai acak dalam batas Indonesia.</p>

                <form method="POST" action="{{ route('tracking.store') }}">
                    @csrf
                    <input type="hidden" name="delivery_id" value="{{ $delivery->id }}">

                    @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded">
                        <ul class="list-disc list-inside text-red-600">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="flex gap-2 mt-6">
                        <button type="submit"
                            class="bg-[#6f1611] text-white px-4 py-2 rounded hover:bg-green-600">
                            Buat Tracking dengan Koordinat Acak
                        </button>
                        <a href="{{ route('delivery.show', $delivery->id) }}"
                            class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>