<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Feedback') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if ($errors->any())
                    <div class="mb-4 text-red-600">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('feedback.update', $feedback->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- Rating -->
                    <div class="mb-4">
                        <label for="rating" class="block font-medium text-sm text-gray-700">Rating (1 - 5)</label>
                        <input type="number" name="rating" id="rating" min="1" max="5"
                            class="form-input rounded-md shadow-sm mt-1 block w-full"
                            value="{{ old('rating', $feedback->rating) }}" required>
                    </div>

                    <!-- Comment -->
                    <div class="mb-4">
                        <label for="comment" class="block font-medium text-sm text-gray-700">Komentar</label>
                        <textarea name="comment" id="comment" rows="4"
                            class="form-input rounded-md shadow-sm mt-1 block w-full"
                            placeholder="Tulis komentar atau saran...">{{ old('comment', $feedback->comment) }}</textarea>
                    </div>

                    <!-- Submit -->
                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button>
                            {{ __('Perbarui Feedback') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>

