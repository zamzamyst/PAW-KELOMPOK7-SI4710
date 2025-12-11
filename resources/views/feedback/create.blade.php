<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Feedback') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                {{-- Display validation errors --}}
                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('feedback.store') }}" method="POST">
                    @csrf

                    <input type="hidden" name="order_id" value="{{ $order->id }}">

                    <div class="mb-4">
                        <label for="rating" class="block text-gray-700 font-semibold mb-2">Rating (1-5)</label>
                        <select name="rating" id="rating" required class="w-full bg-gray-100 border border-gray-300 rounded px-3 py-2">
                            <option value="">-- Select Rating --</option>
                            @for ($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}" {{ old('rating') == $i ? 'selected' : '' }}>
                                    {{ $i }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="comment" class="block text-gray-700 font-semibold mb-2">
                            Comment (optional)
                        </label>
                        <textarea name="comment" id="comment" rows="4" class="w-full bg-gray-100 border border-gray-300 rounded px-3 py-2">
                            {{ old('comment') }}
                        </textarea>
                    </div>

                    <button type="submit" class="bg-[#881a14] text-white px-4 py-2 rounded hover:bg-[#6f1611]">
                        Submit Feedback
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>