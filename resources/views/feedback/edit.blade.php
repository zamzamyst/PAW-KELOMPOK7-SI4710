<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Feedback') }}
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

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('feedback.update', $feedback->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="rating" class="block text-gray-700 text-sm font-bold mb-2">Rating (1-5)</label>
                        <select name="rating" id="rating" required class="form-input w-full border border-gray-300 rounded px-3 py-2">
                            @for ($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}" {{ old('rating', $feedback->rating) == $i ? 'selected' : '' }}>
                                    {{ $i }}
                                </option>
                            @endfor
                        </select>
                        @error('rating')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="comment" class="block text-gray-700 text-sm font-bold mb-2">Comment (optional)</label>
                        <textarea name="comment" id="comment" rows="4" class="form-input w-full border border-gray-300 rounded px-3 py-2">{{ old('comment', $feedback->comment) }}</textarea>
                        @error('comment')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-6 py-2 rounded">
                            Update Feedback
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>