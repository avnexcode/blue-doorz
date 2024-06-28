<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Categories') }}
            </h2>
            <a href="{{route('categories.create')}}">Create New Category</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- TARUH KONTEN DISINI --}}
                    <h1>JANCOK INDEK KATEGORI</h1>
                    @foreach ($categories as $key => $category)
                        <h1 class="text-5xl">{{ str_replace(' ', ' ', ucwords(str_replace('_', ' ', $category->name))) }}</h1>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
