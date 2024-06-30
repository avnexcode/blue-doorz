<x-customer-layout>
    <x-slot name='title'>
        {{ $title }}
    </x-slot>
    <div class="bg-gray-100 h-screen py-8">
        <form action="{{ route('booking.store') }}" method="POST">
            @php
                $tax = $room->price * 0.05;
                $priceWithTax = $room->price + $tax;
            @endphp
            @csrf
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
            <input type="hidden" name="room_id" value="{{ $room->id }}">
            <input type="hidden" name="price" value="{{ $priceWithTax }}">
            <div class="container mx-auto px-4">
                <h1 class="text-2xl font-semibold mb-4">Booking Room in
                    {{ str_replace(' ', ' ', ucwords(str_replace('_', ' ', $room->category->name))) }}</h1>
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="md:w-3/4">
                        <div class="bg-white rounded-lg shadow-md p-6 mb-4">
                            <table class="w-full">
                                <tbody>
                                    <tr>
                                        <td class="py-4">
                                            <div class="flex justify-center flex-col">
                                                <img class="h-full max-w-[400px] min-w-[400px] w-full max-h-[400px] min-h-[400px] mr-4 object-cover mb-3"
                                                    src="{{ asset('storage/' . $room->image) }}" alt="Product image">
                                                <table class="mb-10">
                                                    <tr class="text-left text-base">
                                                        <th>Name</th>
                                                        <td class="pl-10">:
                                                            {{ str_replace(' ', ' ', ucwords(str_replace('_', ' ', $room->name))) }}
                                                        </td>
                                                    </tr>
                                                    <tr class="text-left text-base">
                                                        <th>Price</th>
                                                        <td class="pl-10">: Rp.
                                                            {{ number_format($room->price, 0, ',', '.') }}</td>
                                                    </tr>
                                                    <tr class="text-left text-base">
                                                        <th>Status</th>
                                                        <td class="pl-10">:
                                                            {{ str_replace(' ', ' ', ucwords(str_replace('_', ' ', $room->status))) }}
                                                        </td>
                                                    </tr>
                                                    <tr class="text-left text-base">
                                                        <th>Total Room</th>
                                                        <td class="pl-10">: 1</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </td>
                                        <td class="w-full" colspan="3">
                                            <div>
                                                <div class="mb-8">
                                                    <x-input-label for="phone" :value="__('Phone Number')" />
                                                    <x-text-input id="phone" class="block mt-1 w-full"
                                                        type="text" name="phone" :value="old('phone')" required
                                                        autofocus autocomplete="off" />
                                                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                                                </div>
                                                <div class="mb-8">
                                                    <x-input-label for="nik" :value="__('NIK')" />
                                                    <x-text-input id="nik" class="block mt-1 w-full"
                                                        type="text" name="nik" :value="old('nik')" required
                                                        autofocus autocomplete="off" />
                                                    <x-input-error :messages="$errors->get('nik')" class="mt-2" />
                                                </div>
                                                <div class="mb-8">
                                                    <x-input-label for="started_time" :value="__('Check In')" />
                                                    <x-text-input id="started_time"
                                                        class="block mt-1 w-full hover:cursor-pointer" type="date"
                                                        name="started_time" :value="old('started_time')" required
                                                        autocomplete="off" />
                                                    <x-input-error :messages="$errors->get('started_time')" class="mt-2" />
                                                </div>
                                                <div class="mb-8">
                                                    <x-input-label for="end_time" :value="__('Check Out')" />
                                                    <x-text-input id="end_time"
                                                        class="block mt-1 w-full hover:cursor-pointer" type="date"
                                                        name="end_time" :value="old('end_time')" required
                                                        autocomplete="off" />
                                                    <x-input-error :messages="$errors->get('end_time')" class="mt-2" />
                                                </div>
                                                <div class="mb-8">
                                                    <x-input-label for="payment_method" :value="__('Payment')" />
                                                    <select name="payment_method" id="payment_method"
                                                        class="hover:cursor-pointer border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                                        <option value="">Choose Payment</option>
                                                        <option value="cash">Cash</option>
                                                        <option value="credit" disabled>Creadit Card (coming soon)
                                                        </option>
                                                    </select>
                                                    <x-input-error class="mt-2" :messages="$errors->get('payment_method')" />
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- More product rows -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="md:w-1/4">
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <h2 class="text-lg font-semibold mb-4">Summary</h2>
                            <div class="flex justify-between mb-2">
                                <span>Subtotal</span>
                                <span id="subtotal">Rp. {{ number_format($room->price, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between mb-2">
                                <span>Taxes</span>
                                <span id="taxes">Rp. {{ number_format($tax, 0, ',', '.') }}</span>
                            </div>
                            <hr class="my-2">
                            <div class="flex justify-between mb-2">
                                <span class="font-semibold">Total</span>
                                <span class="font-semibold" id="total">Rp.
                                    {{ number_format($priceWithTax, 0, ',', '.') }}</span>
                            </div>
                            <button @if ($room->status === 'booked') disabled @endif
                                class="{{ $room->status === 'booked' ? 'bg-gray-400' : 'bg-blue-500' }} text-white py-2 px-4 rounded-lg mt-4 w-full">
                                {{ $room->status === 'booked' ? 'Already Booked, Ready on ' . Carbon\Carbon::parse($room->transactions[0]->end_time)->format('l, j F Y') : 'Booking Now' }}
                            </button>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const startedTimeInput = document.getElementById('started_time');
            const endTimeInput = document.getElementById('end_time');
            const subtotalElement = document.getElementById('subtotal');
            const taxesElement = document.getElementById('taxes');
            const totalElement = document.getElementById('total');

            const calculateTotal = () => {
                const startedTime = new Date(startedTimeInput.value);
                const endTime = new Date(endTimeInput.value);

                if (startedTime && endTime) {

                    const timeDiff = Math.abs(endTime - startedTime);
                    const daysCount = Math.ceil(timeDiff / (1000 * 60 * 60 * 24));

                    const subtotal = {{ $room->price }} * daysCount;
                    const taxes = subtotal * 0.05;
                    const total = subtotal + taxes;

                    subtotalElement.textContent = 'Rp. ' + subtotal.toLocaleString();
                    taxesElement.textContent = 'Rp. ' + taxes.toLocaleString();
                    totalElement.textContent = 'Rp. ' + total.toLocaleString();
                }
            }

            startedTimeInput.addEventListener('change', calculateTotal);
            endTimeInput.addEventListener('change', calculateTotal);
        });
    </script>
</x-customer-layout>
