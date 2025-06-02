<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Feedback') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">

                <h1 class="text-2xl font-bold mb-4">Feedback - #{{ $feedback->id }}</h1>
                <hr class="mb-6" />

                {{-- Info Order --}}
                <div class="mb-6 text-sm text-gray-600">
                    <h2 class="text-lg font-semibold mb-2">Order Information</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div><strong>Menu:</strong> {{ $feedback->order->name }}</div>
                        <div><strong>Menu Code:</strong> {{ $feedback->order->menu_code }}</div>
                        <div><strong>Price:</strong> Rp{{ number_format($feedback->order->price, 0, ',', '.') }}</div>
                        <div><strong>Quantity:</strong> {{ $feedback->order->quantity }}</div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-gray-600 text-sm font-semibold mb-1">Rating</label>
                        <input type="text" class="form-input w-full bg-white rounded px-3 py-2" value="{{ $feedback->rating }}" readonly>
                    </div>
                    <div>
                        <label class="block text-gray-600 text-sm font-semibold mb-1">Created At</label>
                        <input type="text" class="form-input w-full bg-white rounded px-3 py-2" value="{{ $feedback->created_at->format('d M Y H:i') }}" readonly>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-600 text-sm font-semibold mb-1">Comment</label>
                    <textarea class="form-input w-full bg-white rounded px-3 py-2" rows="4" readonly>{{ $feedback->comment }}</textarea>
                </div>

                <div class="flex justify-end">
                    <a href="{{ route('feedback') }}"
                        class="inline-block bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-700 text-sm">
                        Return
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>