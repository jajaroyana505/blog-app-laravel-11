<x-app-layout>


    <div class="pt-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 bg-white shadow sm:rounded-lg">
                <div class="p-3 border-b">
                    <h1 class="text-3xl font-medium">{{ $post->title }}</h1>
                    <p class="text-slate-600 py-4">Author: {{ ucwords($post->user->name) }} | {{ date('d M Y', strtotime($post->created_at)) }}</p>
                    <p class="text-slate-800 mt-5">{{ $post->content}} </p>
                    <div class="flex justify-end">
                        <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                <div class="p-4 flex justify-between">
                    <div id="like-section-{{ $post->id }}">
                        @include('post.partials.like-button', ['post' => $post])
                    </div>
                    <div class="inline-flex gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 9.75a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 0 1 .778-.332 48.294 48.294 0 0 0 5.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                        </svg>
                        <p class="text-slate-600">{{ $post->comments()->count() }} Comment</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="pt-3" id="comments">
        @include('post.partials.comment-section', ['post' => $post])
    </div>

</x-app-layout>