<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Delivery') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('delivery.update', $delivery->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Order ID</label>
                        <input type="text" value="{{ $delivery->order_id }}" readonly
                            class="w-full border border-gray-300 rounded px-3 py-2 bg-gray-100" />
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Menu Name</label>
                        <input type="text" value="{{ $delivery->order->name }}" readonly
                            class="w-full border border-gray-300 rounded px-3 py-2 bg-gray-100" />
                    </div>

                    <div class="mb-4">
                        <label for="delivery_address" class="block text-gray-700 font-semibold mb-2">Alamat Pengiriman <span class="text-red-500">*</span></label>
                        <textarea name="delivery_address" id="delivery_address" rows="3" required
                            class="w-full border border-gray-300 rounded px-3 py-2">{{ old('delivery_address', $delivery->delivery_address) }}</textarea>
                        @error('delivery_address')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="delivery_status" class="block text-gray-700 font-semibold mb-2">Status Pengiriman <span class="text-red-500">*</span></label>
                        <select name="delivery_status" id="delivery_status" required
                            class="w-full border border-gray-300 rounded px-3 py-2">
                            <option value="pending" {{ old('delivery_status', $delivery->delivery_status) == 'pending' ? 'selected' : '' }}>Menunggu</option>
                            <option value="in_transit" {{ old('delivery_status', $delivery->delivery_status) == 'in_transit' ? 'selected' : '' }}>Dalam Pengiriman</option>
                            <option value="delivered" {{ old('delivery_status', $delivery->delivery_status) == 'delivered' ? 'selected' : '' }}>Terkirim</option>
                            <option value="cancelled" {{ old('delivery_status', $delivery->delivery_status) == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>
                        @error('delivery_status')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex gap-2">
                        <button type="submit" class="bg-[#881a14] text-white px-4 py-2 rounded hover:bg-[#6f1611]">
                            Update Delivery
                        </button>
                        <a href="{{ route('delivery') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                            Kembali
                        </a>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</x-app-layout>