<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('List Menu') }}
            </h2>
            <a href="{{ route('menu.create') }}"
                class="inline-block bg-[#881a14] text-white px-4 py-2 rounded hover:bg-[#6f1611]">
                Add Menu
            </a>
        </div>
    </x-slot>

</x-app-layout>