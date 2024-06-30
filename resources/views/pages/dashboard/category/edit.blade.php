<x-app-layout>
    <x-slot name="title">
        {{ $title }}
    </x-slot>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Update Category ') . str_replace(' ', ' ', ucwords(str_replace('_', ' ', $category->name))) }}
            </h2>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- TARUH KONTEN DISINI --}}
                    <main>
                        <form action="{{ route('categories.update', $category->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            {{-- Input Name --}}
                            <div class="my-5 flex flex-col">
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                    :value="old('name', $category->name)" required autofocus autocomplete="off" />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                            {{-- Butten Submit --}}
                            <div class="my-5 flex gap-5 justify-end">
                                <a href="{{ route('categories.index') }}">
                                    <x-secondary-button class="max-w-min" type="button">
                                        {{ __('Cancel') }}
                                    </x-secondary-button>
                                </a>
                                <x-primary-button class="max-w-min">
                                    {{ __('Update') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </main>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
