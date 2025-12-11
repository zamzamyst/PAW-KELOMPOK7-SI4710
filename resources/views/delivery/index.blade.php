<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('List Delivery') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (Session::has('success'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ Session::get('success') }}
            </div>
            @endif

            @if (Session::has('error'))
            <div class="mb-4 font-medium text-sm text-red-600">
                {{ Session::get('error') }}
            </div>
            @endif

            @if (Session::has('info'))
            <div class="mb-4 font-medium text-sm text-blue-600">
                {{ Session::get('info') }}
            </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="min-w-full divide-y divide-gray-200 border border-gray-300">
                    <thead class="bg-[#881a14] text-white text-center font-bold">
                        <tr>
                            <th class="px-4 py-2">No.</th>
                            <th class="px-4 py-2">Order ID</th>
                            <th class="px-4 py-2">Menu Name</th>
                            <th class="px-4 py-2">Delivery Address</th>
                            <th class="px-4 py-2">Status</th>
                            <th class="px-4 py-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($deliveries->count() > 0)
                        @foreach ($deliveries as $rs)
                        <tr class="border-t text-center">
                            <td class="px-4 py-2 align-middle">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2 align-middle">{{ $rs->order_id }}</td>
                            <td class="px-4 py-2 align-middle">{{ $rs->order->name ?? '-' }}</td>
                            <td class="px-4 py-2 align-middle">{{ Str::limit($rs->delivery_address, 30) }}</td>
                            <td class="px-4 py-2 align-middle">
                                <span class="px-2 py-1 rounded text-white text-xs {{ $rs->status_badge }}">
                                    {{ $rs->formatted_status }}
                                </span>
                            </td>
                            <td class="px-4 py-2 align-middle">
                                <div class="flex justify-center gap-1 flex-wrap">
                                    <a href="{{ route('delivery.show', $rs->id) }}"
                                        class="bg-green-600 text-white px-2 py-1 rounded hover:bg-green-800 text-sm">Detail</a>

                                    <a href="{{ route('delivery.edit', $rs->id) }}"
                                        class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600 text-sm">Edit</a>
                                        
                                        @if (auth()->user()->hasRole('admin'))
                                        <form action="{{ route('delivery.destroy', $rs->id) }}" method="POST"
                                            onsubmit="return confirm('Hapus delivery ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-600 text-white px-2 py-1 rounded hover:bg-red-700 text-sm">
                                                Delete
                                            </button>
                                        </form>
                                        @endif
                                        
                                    @if(!$rs->tracking)
                                    <a href="{{ route('tracking.create', $rs->id) }}" class="bg-[#881a14] text-white px-2 py-1 rounded hover:bg-red-700 text-sm">Create Tracking</a>
                                    </a>
                                    @else
                                    <a href="{{ route('tracking.show', $rs->tracking->id) }}"
                                        class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600 text-sm">
                                        View Tracking
                                    </a>
                                    @endif

                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="6" class="text-center py-4">Belum ada delivery</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>