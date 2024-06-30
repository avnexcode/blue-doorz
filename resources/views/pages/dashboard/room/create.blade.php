<x-app-layout>
    <style>
        .button_file_input {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 8px 12px 8px 16px;
            gap: 8px;
            border: none;
            background: #c7d2fe;
            border-radius: 20px;
            cursor: pointer;
        }

        .lable {
            margin-top: 1px;
            font-size: 15px;
            line-height: 22px;
            color: #056DFA;
            font-family: sans-serif;
            letter-spacing: 1px;
        }

        .button_file_input:hover {
            background: #6366f1;
        }

        .button_file_input:hover .lable {
            color: white;
        }

        .button_file_input:hover .svg-icon {
            animation: spin 1s linear infinite;
        }

        .button_file_input:hover .svg-icon g {
            stroke: white
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            25% {
                transform: rotate(-8deg);
            }

            50% {
                transform: rotate(0deg);
            }

            75% {
                transform: rotate(8deg);
            }

            100% {
                transform: rotate(0deg);
            }
        }
    </style>
    <x-slot name="title">
        {{ $title }}
    </x-slot>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Create New Room') }}
            </h2>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- TARUH KONTEN DISINI --}}
                    <main>
                        <form action="{{ route('rooms.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            {{-- Input Name --}}
                            <div class="my-5 flex flex-col">
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                    :value="old('name')" required autofocus autocomplete="off" />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                            {{-- Input Number --}}
                            <div class="my-5 flex flex-col">
                                <x-input-label for="room_number" :value="__('Number')" />
                                <x-text-input id="room_number" class="block mt-1 w-full" type="text"
                                    name="room_number" :value="old('room_number')" required autofocus autocomplete="off" />
                                <x-input-error :messages="$errors->get('room_number')" class="mt-2" />
                            </div>
                            {{-- Input Category --}}
                            <div class="my-5 flex flex-col">
                                <x-input-label for="category_id" :value="__('Category')" />
                                <select name="category_id" id="category_id"
                                    class="hover:cursor-pointer border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">Choose Category</option>
                                    @foreach ($categories as $key => $category)
                                        <option value="{{ $category->id }}">
                                            {{ str_replace(' ', ' ', ucwords(str_replace('_', ' ', $category->name))) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- Input Price --}}
                            <div class="my-5 flex flex-col">
                                <x-input-label for="price" :value="__('Price')" />
                                <x-text-input id="price" class="block mt-1 w-full" type="text" name="price"
                                    :value="old('price')" required autofocus autocomplete="off" />
                                <x-input-error :messages="$errors->get('price')" class="mt-2" />
                            </div>
                            {{-- Input Image --}}
                            <div class="my-5 flex flex-col gap-2">
                                <x-input-label for="image" :value="__('Image')" />
                                <img id="image-room"
                                    class="mb-3 w-[150px] aspect-[3/4] object-cover border border-gray-600">
                                <input type="file" id="image" name="image" class="hidden"
                                    onchange="previewImage()">
                                <!-- Custom Button -->
                                <label for="image" class="button_file_input">
                                    <svg class="svg-icon" width="24" viewBox="0 0 24 24" height="24"
                                        fill="none">
                                        <g stroke-width="2" stroke-linecap="round" stroke="#056dfa" fill-rule="evenodd"
                                            clip-rule="evenodd">
                                            <path
                                                d="m3 7h17c.5523 0 1 .44772 1 1v11c0 .5523-.4477 1-1 1h-16c-.55228 0-1-.4477-1-1z">
                                            </path>
                                            <path
                                                d="m3 4.5c0-.27614.22386-.5.5-.5h6.29289c.13261 0 .25981.05268.35351.14645l2.8536 2.85355h-10z">
                                            </path>
                                        </g>
                                    </svg>
                                    <span class="lable">Choose File</span>
                                </label>

                                <!-- Display File Name -->
                                <span id="file-name" class="ml-2 text-gray-600"></span>

                                <x-input-error class="mt-2" :messages="$errors->get('image')" />
                            </div>

                            {{-- Input Status --}}
                            <div class="my-5 flex flex-col">
                                <x-input-label for="status" :value="__('Status')" />
                                <select name="status" id="status"
                                    class="hover:cursor-pointer border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">Choose Status</option>
                                    <option value="available">Available</option>
                                    <option value="booked">Booked</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('status')" />
                            </div>
                            {{-- Input Description --}}
                            <div class="my-5 flex flex-col">
                                <x-input-label for="description" :value="__('Description')" />
                                <textarea class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" name="description" id="description"
                                    placeholder="Buatlah deskripsi dengan minimal 100 kata" cols="" rows="5" maxlength="10000">{{ old('description') }}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('description')" />
                            </div>
                            {{-- Butten Submit --}}
                            <div class="my-5 flex gap-5 justify-end">
                                <a href="{{ route('rooms.index') }}">
                                    <x-secondary-button class="max-w-min" type="button">
                                        {{ __('Batal') }}
                                    </x-secondary-button>
                                </a>
                                <x-primary-button class="max-w-min">
                                    {{ __('Buat') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </main>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
