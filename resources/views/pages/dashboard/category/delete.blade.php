<div>
    <button x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-category-deletion{{ $category->id }}')"
        class="bg-red-500 text-white active:bg-red-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none ease-linear transition-all duration-150">Delete</button>
    <x-modal name="confirm-category-deletion{{ $category->id }}" focusable>
        <form method="post" action="{{ route('categories.destroy', $category->id) }}" class="p-6">
            @csrf
            @method('delete')
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Are you sure you want to delete category ') . str_replace(' ', ' ', ucwords(str_replace('_', ' ', $category->name))) . '?' }}
            </h2>
            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('Delete') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</div>
