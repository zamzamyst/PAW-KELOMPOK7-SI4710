<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('List Feedback') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-4">
                <a href="{{ route('feedback.create') }}"
                    class="bg-[#881a14] text-white px-4 py-2 rounded hover:bg-[#6f1611]">
                    Tambah Feedback
                </a>
            </div>

            @if (Session::has('success'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ Session::get('success') }}
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg p-6 overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 border border-gray-300">
                    <thead class="bg-[#881a14] text-white text-center font-bold">
                        <tr>
                            <th class="px-4 py-2">No.</th>
                            <th class="px-4 py-2">Rating</th>
                            <th class="px-4 py-2">Comment</th>
                            <th class="px-4 py-2">Created At</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($feedbacks as $fb)
                            <tr class="border-t text-center align-middle">
                                <td class="px-4 py-2">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-4 py-2">
                                    {{ $fb->rating }}
                                </td>
                                <td class="px-4 py-2">
                                    {{ Str::limit($fb->comment, 50, '...') }}
                                </td>
                                <td class="px-4 py-2">
                                    {{ $fb->created_at->format('d M Y') }}
                                </td>
                                <td class="px-4 py-2">
                                    <div class="flex justify-center gap-2 flex-wrap">
                                        <a href="{{ route('feedback.show', $fb->id) }}" method="GET"
                                            class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-800 text-sm">
                                            Detail
                                        </a>
                                        <a href="{{ route('feedback.edit', $fb->id) }}" method="GET"
                                            class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 text-sm">
                                            Edit
                                        </a>
                                        <form action="{{ route('feedback.destroy', $fb->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus Feedback ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 text-sm">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    Tidak ada Feedback
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
