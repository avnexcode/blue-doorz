<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Rooms') }}
            </h2>
            <a href={{ route('rooms.create') }}>Create New Room</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- TARUH KONTEN DISINI --}}
                    <h1>JANCOK INDEK RUM</h1>
                    @foreach ($rooms as $key => $room)
                        <img src="{{ asset('storage/' . $room->image) }}" alt="{{ $room->slug }}">
                        <h1 class="text-5xl">{{ str_replace(' ', ' ', ucwords(str_replace('_', ' ', $room->name))) }}
                        </h1>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
