<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Feedback') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-8">
                <h1 class="text-2xl font-bold mb-4">Feedback Detail #{{ $feedback->id }}</h1>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-gray-700 font-semibold mb-1">Rating</label>
                        <input type="text" class="form-input w-full bg-gray-100" value="{{ $feedback->rating }}" readonly>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-1">Created At</label>
                        <input type="text" class="form-input w-full bg-gray-100" value="{{ $feedback->created_at->format('d M Y H:i') }}" readonly>
                    </div>
                </div>
                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Comment</label>
                    <textarea class="form-input w-full bg-gray-100" rows="5" readonly>{{ $feedback->comment }}</textarea>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
