<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('List Order') }}
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

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="min-w-full divide-y divide-gray-200 border border-gray-300">
                    <thead class="bg-[#881a14] text-white text-center font-bold">
                        <tr>
                            <th class="px-4 py-2">No.</th>
                            <th class="px-4 py-2">Menu Code</th>
                            <th class="px-4 py-2">Name</th>
                            <th class="px-4 py-2">Price</th>
                            <th class="px-4 py-2">Quantity</th>
                            <th class="px-4 py-2">Notes</th>
                            <th class="px-4 py-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($order->count() > 0)
                        @foreach ($order as $rs)
                        <tr class="border-t text-center">
                            <td class="px-4 py-2 align-middle">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2 align-middle">{{ $rs->menu_code }}</td>
                            <td class="px-4 py-2 align-middle">{{ $rs->name }}</td>
                            <td class="px-4 py-2 align-middle">Rp {{ number_format($rs->price, 0, ',', '.') }}</td>
                            <td class="px-4 py-2 align-middle">{{ $rs->quantity }}</td>
                            <td class="px-4 py-2 align-middle">{{ $rs->notes }}</td>
                            <td class="px-4 py-2 align-middle">
                                <div class="flex justify-center gap-1 flex-wrap">
                                    <a href="{{ route('order.show', $rs->id) }}"
                                        class="bg-green-600 text-white px-2 py-1 rounded hover:bg-green-800 text-sm">Detail</a>

                                    @if (auth()->user()->hasRole('customer'))
                                    <a href="{{ route('order.create', $rs->menu_code) }}"
                                        class="bg-yellow-500 text-white px-2 py-1 rounded  hover:bg-yellow-600 text-sm">Order</a>
                                    @endif

                                    @if (auth()->user()->hasRole('seller') | auth()->user()->hasRole('admin'))
                                    <a href="{{ route('order.edit', $rs->id) }}"
                                        class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600 text-sm">Edit</a>
                                    <form action="{{ route('order.destroy', $rs->id) }}" method="POST"
                                        onsubmit="return confirm('Delete?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-600 text-white px-2 py-1 rounded hover:bg-red-700 text-sm">
                                            Delete
                                        </button>
                                    </form>
                                    @endif

                                    @if (auth()->user()->hasRole('seller') | auth()->user()->hasRole('admin'))
                                        @if(!$rs->delivery)
                                        <a href="{{ route('delivery.create', $rs->id) }}" class="btn btn-primary">Create Delivery</a>
                                        @else
                                        <a href="{{ route('delivery.show', $rs->delivery->id) }}"
                                            class="bg-[#881a14] text-white px-2 py-1 rounded hover:bg-[#6f1611] text-sm">
                                            View Delivery
                                        </a>
                                        @endif
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="6" class="text-center py-4">Menu not found</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>