<x-app-layout>
    <x-slot name="title">
        {{ $title }}
    </x-slot>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Room') }}
            </h2>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- TARUH KONTEN DISINI --}}
                    <main>
                        <div>
                            <div>
                                <h1 class="text-2xl font-semibold">{{ str_replace(' ', ' ', ucwords(str_replace('_', ' ', $room->name))) }}</h1>
                            </div>
                            <div class="flex gap-5 mt-10">
                                <div class="flex-1">
                                    <img src="{{ asset('storage/' . $room->image) }}" alt="Image Room" class="">
                                </div>
                                <div class="flex-1 text-justify flex flex-col gap-3">
                                    {!! $room->description !!}
                                </div>
                            </div>
                            <div class="mt-10">
                                <table>
                                    <tr>
                                        <th class="text-xl text-left">Price</th>
                                        <td class="text-xl pl-10">: {{ $room->price }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-xl text-left">Number</th>
                                        <td class="text-xl pl-10">: {{ $room->room_number }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-xl text-left">Category</th>
                                        <td class="text-xl pl-10">: {{ $room->category ? str_replace(' ', ' ', ucwords(str_replace('_', ' ', $room->category->name))) : 'Uncategorized' }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="flex gap-3 justify-end items-center mt-10">
                                <a class="bg-gray-500 text-white active:bg-gray-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none ease-linear transition-all duration-150"
                                    href="{{ route('rooms.index') }}">Back</a>
                                <a class="bg-sky-500 text-white active:bg-sky-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none ease-linear transition-all duration-150"
                                    href="{{ route('rooms.edit', $room->id) }}">Edit</a>
                                <form action="{{ route('rooms.destroy', $room->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        class="bg-red-500 text-white active:bg-red-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none ease-linear transition-all duration-150">Delete</button>
                                </form>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
