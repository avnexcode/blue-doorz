<x-app-layout>
    <x-slot name="title">
        {{ $title }}
    </x-slot>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Rooms') }}
            </h2>
            <a href={{ route('rooms.create') }}>
                <x-secondary-button class="max-w-max" type="button">
                    {{ __('Create New Room') }}
                </x-secondary-button>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- TARUH KONTEN DISINI --}}
                    <main>
                        <div class="rounded-t mb-0 px-4 py-3 border-0">

                            <div class="flex flex-wrap items-center justify-between">
                                <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                                    <h3 class="font-semibold text-base text-blueGray-700">Table Data</h3>
                                </div>
                                <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                                    <form class="flex items-center gap-1 justify-end">
                                        <div class="flex items-center">
                                            <x-text-input id="search"
                                                class="block w-full px-1 py-[1.5px] min-w-[300px]" type="text"
                                                name="search" :value="request('search')" autocomplete="off" />
                                        </div>
                                        <div class="flex items-center">
                                            <button
                                                class="bg-indigo-500 text-white active:bg-indigo-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none ease-linear transition-all duration-150"
                                                type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                                        </div>
                                        <div class="flex items-center">
                                            <a href="{{ route('rooms.index') }}"
                                                class="bg-indigo-500 text-white active:bg-indigo-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none ease-linear transition-all duration-150"
                                                type="submit"><i class="fa-solid fa-rotate-right"></i></a>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                        <div class="block w-full overflow-x-auto">
                            <table class="items-center bg-transparent w-full border-collapse ">
                                <thead>
                                    <tr>
                                        <th
                                            class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-sm uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                            No
                                        </th>
                                        <th
                                            class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-sm uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                            Name
                                        </th>
                                        <th
                                            class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-sm uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                            Category
                                        </th>
                                        <th
                                            class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-sm uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                            Price
                                        </th>
                                        <th
                                            class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-sm uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                            Status
                                        </th>
                                        <th
                                            class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-sm uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-center">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($rooms) > 0)
                                        @foreach ($rooms as $key => $room)
                                            <tr>
                                                <th
                                                    class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap p-4 text-left text-blueGray-700 ">
                                                    {{ $key + 1 }}
                                                </th>
                                                <th
                                                    class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap p-4 text-left text-blueGray-700 ">
                                                    {{ str_replace(' ', ' ', ucwords(str_replace('_', ' ', $room->name))) }}
                                                </th>
                                                <td
                                                    class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap p-4 ">
                                                    {{ $room->category ? str_replace(' ', ' ', ucwords(str_replace('_', ' ', $room->category->name))) : 'Uncategorized' }}
                                                </td>
                                                <td
                                                    class="border-t-0 px-6 align-center border-l-0 border-r-0 text-sm whitespace-nowrap p-4">
                                                    Rp. {{ number_format($room->price, 0, ',', '.') }}
                                                </td>
                                                <td
                                                    class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap p-4">
                                                    {{ str_replace(' ', ' ', ucwords(str_replace('_', ' ', $room->status))) }}
                                                </td>
                                                <td
                                                    class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap p-4">
                                                    <div class="flex gap-2 justify-center">
                                                        <a class="bg-green-500 text-white active:bg-green-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none ease-linear transition-all duration-150"
                                                            href="{{ route('rooms.show', $room->id) }}">Detail</a>
                                                        <a class="bg-sky-500 text-white active:bg-sky-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none ease-linear transition-all duration-150"
                                                            href="{{ route('rooms.edit', $room->id) }}">Edit</a>
                                                        @include('pages.dashboard.room.delete')
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="6" class="text-center py-5 text-xl text-blue-500">
                                                Data tidak ditemukan.
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            <div class="py-10 px-10">
                                {{ $rooms->links('') }}
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
