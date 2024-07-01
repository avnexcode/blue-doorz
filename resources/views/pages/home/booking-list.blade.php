<x-customer-layout>
    <x-slot name='title'>
        {{ $title }}
    </x-slot>
    <div class="bg-gray-100 min-h-screen py-8">
        <div class="container mx-auto mt-10">
            <div class="sm:flex shadow-md my-10">
                <div class="w-full bg-white px-10 py-10">
                    <div class="flex justify-between border-b pb-8">
                        <h1 class="font-semibold text-2xl">Booking List</h1>
                        <h2 class="font-semibold text-2xl">{{ count($transactions) }} Room</h2>
                    </div>
                    @if (count($transactions) > 0)
                        @foreach ($transactions as $key => $transaction)
                            <div class="md:flex py-8 md:py-10 lg:py-8 border-t border-gray-50 w-full gap-3">
                                <div class="md:w-4/12 2xl:w-1/4 w-full">
                                    <img src="{{ asset('storage/' . $transaction->room->image) }}"
                                        alt="Black Leather Purse"
                                        class="h-full object-center object-cover md:block hidden" />
                                </div>
                                <div class="w-full">
                                    <table class="w-full border-collapse">
                                        <thead>
                                            <tr class="bg-gray-200">
                                                <th class="text-left px-4 py-2">Category</th>
                                                <th class="text-left px-4 py-2">Room</th>
                                                <th class="text-left px-4 py-2">Booking</th>
                                                <th class="text-left px-4 py-2">Price</th>
                                                <th class="text-left px-4 py-2">Check In</th>
                                                <th class="text-left px-4 py-2">Check Out</th>
                                                <th class="text-left px-4 py-2">Peymant Method</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="border-b border-gray-300">
                                                <td class="text-sm text-gray-600 px-4 py-3">
                                                    {{ str_replace(' ', ' ', ucwords(str_replace('_', ' ', $transaction->room->category->name))) }}
                                                </td>
                                                <td class="text-sm text-gray-600 px-4 py-3">
                                                    {{ str_replace(' ', ' ', ucwords(str_replace('_', ' ', $transaction->room->name))) }}
                                                </td>
                                                <td class="text-sm text-gray-600 px-4 py-3">
                                                    {{ $transaction->total_day }}
                                                    Hari</td>
                                                <td class="text-sm text-gray-600 px-4 py-3">Rp
                                                    {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                                                <td class="text-sm text-gray-600 px-4 py-3">
                                                    {{ \Carbon\Carbon::parse($transaction->started_time)->format('j F Y') }}
                                                </td>
                                                <td class="text-sm text-gray-600 px-4 py-3">
                                                    {{ \Carbon\Carbon::parse($transaction->end_time)->format('j F Y') }}
                                                </td>
                                                <td class="text-sm text-gray-600 px-4 py-3">
                                                    {{ str_replace(' ', ' ', ucwords(str_replace('_', ' ', $transaction->payment_method))) }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <div class="w-full flex items-center justify-between pt-5">
                                        <div class="flex items-center justify-end w-full">
                                            <p class="text-lg underline text-gray-800 cursor-pointer">Add to favorites
                                            </p>
                                            <p class="text-lg text-red-500 pl-5 cursor-pointer">Cancel</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="flex w-full justify-center items-center pt-20 flex-col">
                            <h1 class="text-3xl font-semibold text-cyan-400">Tidak ada data transaksi</h1>
                            <a href="{{ route('pages.home') }}" class="underline mt-2">Lakukan pemesanan sekarang</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-customer-layout>
