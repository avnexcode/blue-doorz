<div>
    <button x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-room-deletion{{ $transaction->id }}')"
        class="bg-red-500 text-white active:bg-red-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none ease-linear transition-all duration-150">Cancel</button>
    <x-modal name="confirm-room-deletion{{ $transaction->id }}" focusable>
        <form method="post" action="{{ route('booking.update', $transaction->id) }}" class="p-6">
            @csrf
            @method('patch')
            <input type="hidden" name="transaction_id" value="{{ $transaction->id }}">
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Are you sure you want to cancel?') }}
            </h2>
            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('No') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('Yes') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</div>
