<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>{{ $title }}</title>
    <style>
        @media print {
            .print-small-text {
                font-size: 0.5rem;
            }
            .signature-section {
                font-size: 0.75rem;
            }
        }
    </style>
</head>

<body class="bg-white text-gray-800 font-sans">
    <main class="px-6 py-8">
        <div class="flex flex-col items-center justify-center border-b border-black pb-4">
            <div>
                <img src="{{ asset('icon/bluedoorz.png') }}" alt="Blue Doorz Logo" class="h-12">
            </div>
            <div class="flex justify-center flex-col items-center">
                <p class="text-gray-600">Jalan Pusat Kota No. 666, Kota Lodoyo, Indonesia.</p>
                <p class="text-gray-600">Telp: 081515379818 | Email: axnvee18@gmail.com</p>
            </div>
        </div>
        <table class="w-full border-collapse print-small-text mt-20">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-4 py-2 text-left">No</th>
                    <th class="text-left px-4 py-2">Category</th>
                    <th class="text-left px-4 py-2">Room</th>
                    <th class="text-left px-4 py-2">Booking</th>
                    <th class="text-left px-4 py-2">Price</th>
                    <th class="text-left px-4 py-2">Check In</th>
                    <th class="text-left px-4 py-2">Check Out</th>
                    <th class="text-left px-4 py-2">Payment Method</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $key => $transaction)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $key + 1 }}</td>
                        <td class="px-4 py-2">
                            {{ str_replace(' ', ' ', ucwords(str_replace('_', ' ', $transaction->room->category->name))) }}
                        </td>
                        <td class="px-4 py-2">
                            {{ str_replace(' ', ' ', ucwords(str_replace('_', ' ', $transaction->room->name))) }}</td>
                        <td class="px-4 py-2">{{ $transaction->total_day }} Hari</td>
                        <td class="px-4 py-2">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($transaction->started_time)->format('j F Y') }}
                        </td>
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($transaction->end_time)->format('j F Y') }}</td>
                        <td class="px-4 py-2">
                            {{ str_replace(' ', ' ', ucwords(str_replace('_', ' ', $transaction->payment_method))) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" class="px-4 py-2 font-bold text-right">Total Revenue</td>
                    <td colspan="4" class="px-4 py-2 font-bold">IDR {{ number_format($transactions->sum('total_price'), 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>
        <div class="mt-20 signature-section text-center">
            <div class="flex justify-between">
                <div class="text-center flex flex-col gap-10">
                    <p class="font-bold">Admin</p>
                    <p>(____________________)</p>
                </div>
                <div class="text-center flex flex-col gap-10">
                    <p class="font-bold">Manager</p>
                    <p>(____________________)</p>
                </div>
                <div class="text-center flex flex-col gap-10">
                    <p class="font-bold">Kelompok 1</p>
                    <p>(____________________)</p>
                </div>
            </div>
        </div>
    </main>
    <script>
        window.print()
    </script>
</body>

</html>
