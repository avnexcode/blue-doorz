<x-customer-layout>
    <style>
        .card:hover .card-info {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
    <x-slot name="title">
        {{ $title }}
    </x-slot>
    <div class="px-3">
        @include('components.customer.hero')
    </div>
    <main>
        <div class="p-5 sm:p-8">
            {{--  --}}
            @if (count($categories) > 0)
                @foreach ($categories as $key => $category)
                    <div class="flex justify-center items-center p-10">
                        <h1
                            class="text-3xl font-semibold py-3 px-24 border-black @if ($key % 2 === 0) border-b-2 border-r-2
                    @else border-t-2 border-l-2 @endif">
                            {{ str_replace(' ', ' ', ucwords(str_replace('_', ' ', $category->name))) }}</h1>
                    </div>
                    <div
                        class="columns-1 gap-5 sm:columns-2 sm:gap-8 md:columns-3 lg:columns-4 [&>img:not(:first-child)]:mt-8">
                        @foreach ($rooms as $key => $room)
                            @if ($room->category_id === $category->id)
                                <div
                                    class="card bg-base-100 image-full w-full mb-3 hover:cursor-pointer relative overflow-hidden">
                                    <figure
                                        class="transition-transform duration-300 ease-in-out transform hover:scale-110">
                                        <img src="{{ asset('storage/' . $room->image) }}" alt=""
                                            class="object-cover w-full">
                                    </figure>
                                    <div class="card-body relative z-10 text-white">
                                        <h2 class="card-title">
                                            {{ str_replace(' ', ' ', ucwords(str_replace('_', ' ', $room->category->name))) }}
                                        </h2>
                                        <p>{{ str_replace(' ', ' ', ucwords(str_replace('_', ' ', $room->name))) }}</p>
                                        <p>Rp. {{ number_format($room->price, 0, ',', '.') }} |
                                            {{ str_replace(' ', ' ', ucwords(str_replace('_', ' ', $room->status))) }}
                                        </p>
                                        <div class="card-actions justify-end">
                                            <a href="{{ route('booking', ['id' => $room->id]) }}"
                                                class="btn btn-sm btn-info">Booking Now</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endforeach
            @else
            <div class="w-full flex justify-center">
                <div role="alert" class="alert alert-info max-w-[50%]">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      class="h-6 w-6 shrink-0 stroke-current">
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>Data Tidak Ditemukan</span>
                  </div>
            </div>
            @endif
        </div>
    </main>
</x-customer-layout>
