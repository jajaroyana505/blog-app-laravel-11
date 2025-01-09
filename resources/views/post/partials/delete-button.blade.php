<button
    x-data=""
    x-on:click.prevent="$dispatch('open-modal', 'confirm-post-deletion-{{ $post->id }}')" class="text-gray-500 hover:text-red-600">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
    </svg>
</button>

<x-modal name="confirm-post-deletion-{{ $post->id }}" :show="$errors->userDeletion->isNotEmpty()" focusable>
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-xl font-semibold mb-4">Are you sure you want to delete?</h2>
        <p class="mb-4 text-gray-600">This action cannot be undone.</p>
        <div class="flex justify-end">


            <x-secondary-button x-on:click="$dispatch('close')" type="button">
                Cancel
            </x-secondary-button>

            <form method="POST" class="ml-2" action="{{ route('posts.destroy', $post->id) }}">
                @csrf
                @method('DELETE')
                <x-danger-button type="submit" class="ml-2">
                    Delete
                </x-danger-button>
            </form>
        </div>
    </div>
</x-modal>