<x-app-layout>
    <x-slot name="title">
        {{ $title }}
    </x-slot>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Update Transaction') }}
            </h2>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- TARUH KONTEN DISINI --}}
                    <main>
                        <form action="{{ route('transactions.update', $transaction->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="room_id" value="{{$transaction->room_id}}">
                            <input type="hidden" name="user_id" value="{{$transaction->user_id}}">
                            {{-- Input Customer --}}
                            <div class="my-5 flex flex-col">
                                <x-input-label :value="__('Customer')" />
                                <x-text-input
                                    value="{{ str_replace(' ', ' ', ucwords(str_replace('_', ' ', $transaction->user->name))) }}"
                                    readonly disabled />
                            </div>
                            {{-- Input Phone --}}
                            <div class="my-5 flex flex-col">
                                <x-input-label for="phone" :value="__('Customer Phone Number')" />
                                <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone"
                                    :value="old('phone', $transaction->phone)" required autofocus autocomplete="off" readonly disabled />
                                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                            </div>
                            {{-- Input Email --}}
                            <div class="my-5 flex flex-col">
                                <x-input-label :value="__('Email')" />
                                <x-text-input value="{{ $transaction->user->email }}" readonly disabled />
                            </div>
                            {{-- Input NIK --}}
                            <div class="my-5 flex flex-col">
                                <x-input-label for="nik" :value="__('NIK')" />
                                <x-text-input id="nik" class="block mt-1 w-full" type="text" name="nik"
                                    :value="old('nik', $transaction->nik)" required autofocus autocomplete="off" readonly disabled />
                                <x-input-error :messages="$errors->get('price')" class="mt-2" />
                            </div>
                            {{-- Input Room --}}
                            <div class="my-5 flex flex-col">
                                <x-input-label :value="__('Room')" />
                                <x-text-input
                                    value="{{ str_replace(' ', ' ', ucwords(str_replace('_', ' ', $transaction->room->name))) }}"
                                    readonly disabled />
                            </div>
                            {{-- Input Check In --}}
                            <div class="my-5 flex flex-col">
                                <x-input-label for="started_time" :value="__('Check In')" />
                                <x-text-input id="started_time" class="block mt-1 w-full" type="date"
                                    name="started_time" :value="old('started_time', $transaction->started_time)" required autofocus autocomplete="off"
                                    readonly disabled />
                                <x-input-error :messages="$errors->get('price')" class="mt-2" />
                            </div>
                            {{-- Input Check Out --}}
                            <div class="my-5 flex flex-col">
                                <x-input-label for="end_time" :value="__('Check Out')" />
                                <x-text-input id="end_time" class="block mt-1 w-full" type="date" name="end_time"
                                    :value="old('end_time', $transaction->end_time)" required autofocus autocomplete="off" readonly disabled />
                                <x-input-error :messages="$errors->get('price')" class="mt-2" />
                            </div>
                            {{-- Input Price --}}
                            <div class="my-5 flex flex-col">
                                <x-input-label :value="__('Price')" />
                                <x-text-input value="Rp. {{ number_format($transaction->room->price, 0, ',', '.') }}"
                                    readonly disabled />
                            </div>
                            {{-- Input Total Day --}}
                            <div class="my-5 flex flex-col">
                                <x-input-label for="total_day" :value="__('Total Day')" />
                                <x-text-input id="total_day" class="block mt-1 w-full" type="text" name="total_day"
                                    :value="old('total_day', $transaction->total_day)" required autofocus autocomplete="off" readonly disabled />
                                <x-input-error :messages="$errors->get('price')" class="mt-2" />
                            </div>
                            {{-- Input Total Price --}}
                            <div class="my-5 flex flex-col">
                                <x-input-label for="total_price" :value="__('Total Price')" />
                                <x-text-input id="total_price" class="block mt-1 w-full" type="text"
                                    name="total_price" :value="old('total_price', $transaction->total_price)" required autofocus autocomplete="off" readonly
                                    disabled />
                                <x-input-error :messages="$errors->get('price')" class="mt-2" />
                            </div>
                            {{-- Input Payment Method --}}
                            <div class="my-5 flex flex-col">
                                <x-input-label for="status" :value="__('Status')" />
                                <select name="status" id="status" readonly disabled
                                    class="hover:cursor-pointer border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="cash" {{ $transaction->status == 'cash' ? 'selected' : '' }}>Cash
                                    </option>
                                    <option value="credit" {{ $transaction->status == 'credit' ? 'selected' : '' }}
                                        disabled>Credit Card (Coming Soon)</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('status')" />
                            </div>
                            {{-- Input Status --}}
                            <div class="my-5 flex flex-col">
                                <x-input-label for="status" :value="__('Status')" />
                                <select name="status" id="status"
                                    class="hover:cursor-pointer border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="pending" {{ $transaction->status == 'pending' ? 'selected' : '' }}>
                                        Pending</option>
                                    <option value="ongoing" {{ $transaction->status == 'ongoing' ? 'selected' : '' }}>
                                        On Going</option>
                                    <option value="expired" {{ $transaction->status == 'expired' ? 'selected' : '' }}>
                                        Expired</option>
                                    <option value="canceled"
                                        {{ $transaction->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('status')" />
                            </div>
                            {{-- Butten Submit --}}
                            <div class="my-5 flex gap-5 justify-end">
                                <a href="{{ route('rooms.index') }}">
                                    <x-secondary-button class="max-w-min" type="button">
                                        {{ __('Batal') }}
                                    </x-secondary-button>
                                </a>
                                <x-primary-button class="max-w-min">
                                    {{ __('Perbarui') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </main>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
