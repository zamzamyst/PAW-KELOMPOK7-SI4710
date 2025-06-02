<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Feedback') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto border-collapse">
                        <thead>
                            <tr class="bg-gray-100 text-left text-gray-700">
                                <th class="px-4 py-2">#</th>
                                <th class="px-4 py-2">Menu</th>
                                <th class="px-4 py-2">Rating</th>
                                <th class="px-4 py-2">Comment</th>
                                <th class="px-4 py-2">Created At</th>
                                <th class="px-4 py-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($feedbacks as $item)
                                <tr class="border-b">
                                    <td class="px-4 py-2">{{ $item->id }}</td>
                                    <td class="px-4 py-2">{{ $item->order->name ?? '-' }}</td>
                                    <td class="px-4 py-2">{{ $item->rating }}</td>
                                    <td class="px-4 py-2">{{ Str::limit($item->comment, 30) }}</td>
                                    <td class="px-4 py-2">{{ $item->created_at->format('d M Y') }}</td>
                                    <td class="px-4 py-2 space-x-2">
                                        <a href="{{ route('feedback.show', $item->id) }}" class="text-blue-600 hover:underline">Detail</a>
                                        <a href="{{ route('feedback.edit', $item->id) }}" class="text-yellow-600 hover:underline">Edit</a>
                                        <form action="{{ route('feedback.destroy', $item->id) }}" method="POST" class="inline"
                                            onsubmit="return confirm('Yakin ingin menghapus feedback ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-gray-500">Belum ada feedback</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
