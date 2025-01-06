<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Posts') }}
            </h2>
            <x-primary-button>
                <a href="{{ route('posts.create') }}">Create Post</a>
            </x-primary-button>

        </div>
    </x-slot>
    @include('post.partials.post-list-item')
</x-app-layout>