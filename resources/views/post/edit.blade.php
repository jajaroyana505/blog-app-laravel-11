<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Post') }}
            </h2>

        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <form method="POST" action="{{ route('posts.update', $post->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-5">
                        <x-input-label for="title" :value="__('Title')" />
                        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" value="{{ $post->title }}" required />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />

                    </div>
                    <div class="mb-5">
                        <x-input-label for="content" :value="__('Content')" />
                        <x-textarea-input :rows="5" id="content" class="block mt-1 w-full" type="text" name="content" value="{{ $post->content }}" required />
                        <x-input-error :messages="$errors->get('content')" class="mt-2" />
                        <x-primary-button class="mt-4">
                            {{ __('Update Post') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>