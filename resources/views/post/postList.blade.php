<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-end">

            <x-primary-button>
                <a href="{{ route('posts.create') }}">Create Post</a>
            </x-primary-button>
        </div>
    </x-slot>
    @include('post.partials.post-list-item')
</x-app-layout>