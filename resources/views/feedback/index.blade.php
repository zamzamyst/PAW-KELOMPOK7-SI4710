<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Daftar Feedback') }}
            </h2>
            @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('seller'))
            <a href="{{ route('feedback.create') }}"
                class="inline-block bg-[#881a14] text-white px-4 py-2 rounded hover:bg-[#6f1611]">
                Add Feedback
            </a>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('success') }}
            </div>
            @endif

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <table class="min-w-full divide-y divide-gray-200 border border-gray-300">
                    <thead class="bg-[#881a14] text-white text-center font-bold">
                        <tr>
                            <th class="px-4 py-2">#</th>
                            <th class="px-4 py-2">Menu</th>
                            <th class="px-4 py-2">Rating</th>
                            <th class="px-4 py-2">Comment</th>
                            <th class="px-4 py-2">Created At</th>
                            <th class="px-4 py-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($feedbacks->count() > 0)
                        @foreach ($feedbacks as $item)
                        <tr class="border-t text-center">
                            <td class="px-4 py-2 align-middle">{{ $item->id }}</td>
                            <td class="px-4 py-2 align-middle">{{ $item->order->name ?? '-' }}</td>
                            <td class="px-4 py-2 align-middle">{{ $item->rating }}</td>
                            <td class="px-4 py-2 align-middle">{{ Str::limit($item->comment, 30) }}</td>
                            <td class="px-4 py-2 align-middle">{{ $item->created_at->format('d M Y') }}</td>
                            <td class="px-4 py-2 align-middle">
                                <div class="flex justify-center gap-1 flex-wrap">
                                    <a href="{{ route('feedback.show', $item->id) }}"
                                        class="bg-green-600 text-white px-2 py-1 rounded hover:bg-green-800 text-sm">Detail</a>
                                    <a href="{{ route('feedback.edit', $item->id) }}"
                                        class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600 text-sm">Edit</a>
                                    <form action="{{ route('feedback.destroy', $item->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus feedback ini?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-600 text-white px-2 py-1 rounded hover:bg-red-700 text-sm">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="6" class="text-center py-4 text-gray-500">Belum ada feedback</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
