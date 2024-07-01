<x-app-layout>
    <x-slot name="title">
        {{ $title }}
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Transactions') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- TARUH KONTEN DISINI --}}
                    <main>
                        <div class="my-5 flex flex-col">
                            <x-input-label :value="__('Customer')" />
                            <x-text-input
                                value="{{ str_replace(' ', ' ', ucwords(str_replace('_', ' ', $transaction->user->name))) }}"
                                readonly disabled />
                        </div>
                        <div class="my-5 flex flex-col">
                            <x-input-label :value="__('Phone')" />
                            <x-text-input
                                value="{{ str_replace(' ', ' ', ucwords(str_replace('_', ' ', $transaction->phone))) }}"
                                readonly disabled />
                        </div>
                        <div class="my-5 flex flex-col">
                            <x-input-label :value="__('Email')" />
                            <x-text-input value="{{ $transaction->user->email }}" readonly disabled />
                        </div>
                        <div class="my-5 flex flex-col">
                            <x-input-label :value="__('NIK')" />
                            <x-text-input
                                value="{{ str_replace(' ', ' ', ucwords(str_replace('_', ' ', $transaction->nik))) }}"
                                readonly disabled />
                        </div>
                        <div class="my-5 flex flex-col">
                            <x-input-label :value="__('Room')" />
                            <x-text-input
                                value="{{ str_replace(' ', ' ', ucwords(str_replace('_', ' ', $transaction->room->name))) }}"
                                readonly disabled />
                        </div>
                        <div class="my-5 flex flex-col">
                            <x-input-label :value="__('Check In')" />
                            <x-text-input
                                value="{{ str_replace(' ', ' ', ucwords(str_replace('_', ' ', \Carbon\Carbon::parse($transaction->started_time)->format('l, j F Y')))) }}"
                                readonly disabled />
                        </div>
                        <div class="my-5 flex flex-col">
                            <x-input-label :value="__('Check Out')" />
                            <x-text-input
                                value="{{ str_replace(' ', ' ', ucwords(str_replace('_', ' ', \Carbon\Carbon::parse($transaction->end_time)->format('l, j F Y')))) }}"
                                readonly disabled />
                        </div>
                        <div class="my-5 flex flex-col">
                            <x-input-label :value="__('Price')" />
                            <x-text-input value="Rp. {{ number_format($transaction->room->price, 0, ',', '.') }}" readonly
                                disabled />
                        </div>
                        <div class="my-5 flex flex-col">
                            <x-input-label :value="__('Total Day')" />
                            <x-text-input value="{{ $transaction->total_day }}" readonly
                                disabled />
                        </div>
                        <div class="my-5 flex flex-col">
                            <x-input-label :value="__('Total Price')" />
                            <x-text-input value="Rp. {{ number_format($transaction->total_price, 0, ',', '.') }}" readonly
                                disabled />
                        </div>
                        <div class="my-5 flex flex-col">
                            <x-input-label :value="__('Payment Method')" />
                            <x-text-input
                                value="{{ str_replace(' ', ' ', ucwords(str_replace('_', ' ', $transaction->payment_method))) }}"
                                readonly disabled />
                        </div>
                        <div class="my-5 flex flex-col">
                            <x-input-label :value="__('Status')" />
                            <x-text-input
                                value="{{ str_replace(' ', ' ', ucwords(str_replace('_', ' ', $transaction->status))) }}"
                                readonly disabled />
                        </div>
                        <div class="flex gap-3 justify-end items-center mt-10">
                            <a class="bg-gray-500 text-white active:bg-gray-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none ease-linear transition-all duration-150"
                                href="{{ route('transactions.index') }}">Back</a>
                            <a class="bg-sky-500 text-white active:bg-sky-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none ease-linear transition-all duration-150"
                                href="{{ route('transactions.edit', $transaction->id) }}">Save</a>
                            <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button
                                    class="bg-red-500 text-white active:bg-red-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none ease-linear transition-all duration-150">Delete</button>
                            </form>
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
