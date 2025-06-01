<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Feedback') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">

                <h1 class="text-2xl font-bold mb-4">
                    Feedback #{{ $feedback->id }}
                </h1>
                <hr class="mb-6" />

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Rating
                    </label>
                    <input type="text" class="form-input w-full bg-gray-100 border border-gray-300 rounded px-3 py-2" value="{{ $feedback->rating }}" readonly>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Created At
                    </label>
                    <input type="text" class="form-input w-full bg-gray-100 border border-gray-300 rounded px-3 py-2" value="{{ $feedback->created_at->format('d M Y H:i') }}" readonly>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Comment
                    </label>
                    <textarea class="form-input w-full bg-gray-100 border border-gray-300 rounded px-3 py-2" rows="4" readonly>
                        {{ $feedback->comment }}
                    </textarea>
                </div>

                <div class="flex justify-end space-x-2">
                    <a href="{{ route('feedback.edit', $feedback->id) }}" 
                        class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-4 py-2 rounded">
                        Edit
                    </a>
                    <a href="{{ route('feedback.index') }}" 
                        class="bg-gray-500 hover:bg-gray-600 text-white font-semibold px-4 py-2 rounded">
                        Back
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
