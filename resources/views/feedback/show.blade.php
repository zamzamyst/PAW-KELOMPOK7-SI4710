<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Feedback') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">

                <div class="mb-4">
                    <h3 class="text-lg font-semibold text-gray-700">Nama Pengguna</h3>
                    <p class="text-gray-900">{{ $feedback->user->name }}</p>
                </div>

                <div class="mb-4">
                    <h3 class="text-lg font-semibold text-gray-700">Rating</h3>
                    <p class="text-gray-900">{{ $feedback->rating }} / 5</p>
                </div>

                <div class="mb-4">
                    <h3 class="text-lg font-semibold text-gray-700">Komentar</h3>
                    <p class="text-gray-900 whitespace-pre-line">{{ $feedback->comment }}</p>
                </div>

                <div class="mb-4">
                    <h3 class="text-lg font-semibold text-gray-700">Dibuat Pada</h3>
                    <p class="text-gray-900">{{ $feedback->created_at->format('d M Y, H:i') }}</p>
                </div>

                <div class="flex items-center gap-4 mt-6">
                    <a href="{{ route('feedback.index') }}" class="text-blue-600 hover:underline">← Kembali ke daftar</a>

                    @if ($feedback->user_id === auth()->id())
                        <a href="{{ route('feedback.edit', $feedback->id) }}" class="text-yellow-500 hover:underline">Edit</a>

                        <form action="{{ route('feedback.destroy', $feedback->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus feedback ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>