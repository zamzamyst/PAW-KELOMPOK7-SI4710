<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update Koordinat Tracking') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Informasi Tracking Saat Ini</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6 p-4 bg-gray-50 rounded">
                    <div>
                        <p class="text-gray-600 font-semibold">Tracking ID:</p>
                        <p class="text-gray-800">{{ $tracking->id }}</p>
                    </div>

                    <div>
                        <p class="text-gray-600 font-semibold">Delivery ID:</p>
                        <p class="text-gray-800">{{ $tracking->delivery_id }}</p>
                    </div>

                    <div>
                        <p class="text-gray-600 font-semibold">Order ID:</p>
                        <p class="text-gray-800">{{ $tracking->delivery->order_id ?? '-' }}</p>
                    </div>

                    <div>
                        <p class="text-gray-600 font-semibold">Menu Name:</p>
                        <p class="text-gray-800">{{ $tracking->delivery->order->name ?? '-' }}</p>
                    </div>

                    <div class="md:col-span-2">
                        <p class="text-gray-600 font-semibold">Koordinat Saat Ini:</p>
                        <p class="text-gray-800 text-lg font-mono">{{ $tracking->formatted_coordinates }}</p>
                    </div>
                </div>

                <hr class="my-6">

                <h3 class="text-lg font-bold mb-4">Update Koordinat</h3>
                <p class="text-gray-600 mb-4">Klik tombol di bawah untuk generate koordinat acak yang baru.</p>

                <form method="POST" action="{{ route('tracking.update', $tracking->id) }}">
                    @csrf
                    @method('PUT')

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
                            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            Generate Koordinat Baru
                        </button>
                        <a href="{{ route('tracking.show', $tracking->id) }}"
                            class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>