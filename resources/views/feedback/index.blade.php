<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('List Feedback') }}
            </h2>
            <a href="{{ route('feedback.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                + Tambah Feedback
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <table class="min-w-full table-auto">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left">User</th>
                            <th class="px-4 py-2 text-left">Rating</th>
                            <th class="px-4 py-2 text-left">Komentar</th>
                            <th class="px-4 py-2 text-left">Tanggal</th>
                            <th class="px-4 py-2 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($feedbacks as $feedback)
                            <tr class="border-b">
                                <td class="px-4 py-2">{{ $feedback->user->name }}</td>
                                <td class="px-4 py-2">{{ $feedback->rating }}</td>
                                <td class="px-4 py-2">{{ Str::limit($feedback->comment, 50) }}</td>
                                <td class="px-4 py-2">{{ $feedback->created_at->format('d M Y') }}</td>
                                <td class="px-4 py-2 flex gap-2">
                                    <a href="{{ route('feedback.show', $feedback->id) }}" class="text-blue-500 hover:underline">Lihat</a>
                                    
                                    @if ($feedback->user_id === auth()->id())
                                        <a href="{{ route('feedback.edit', $feedback->id) }}" class="text-yellow-500 hover:underline">Edit</a>

                                        <form action="{{ route('feedback.destroy', $feedback->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center px-4 py-4">Belum ada feedback.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>