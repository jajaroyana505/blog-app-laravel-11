<x-app-layout>


    <div class="pt-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 bg-white shadow sm:rounded-lg">
                <div class="p-3 border-b">
                    <h1 class="text-3xl font-medium">{{ $blog->title }}</h1>
                    <p class="text-slate-600 py-4">Author: {{ ucwords($blog->user->name) }} | Created at: {{ date('d M Y', strtotime($blog->created_at)) }}</p>
                    <p class="text-slate-800 mt-5">{{ $blog->content}} </p>
                </div>
                <div class="p-4 flex justify-between">
                    <div class="inline-flex gap-2">
                        <p class="text-slate-600">3399.K</p>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z" />
                        </svg>

                    </div>
                    <div class="inline-flex gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 9.75a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 0 1 .778-.332 48.294 48.294 0 0 0 5.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                        </svg>
                        <p class="text-slate-600">25 Comment</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="pt-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-8 bg-white shadow sm:rounded-lg">
                <p class="text-xl font-semibold text-slate-600 mb-3">Comments</p>
                <form method="POST" action="{{ route('posts.comment', $blog->id) }}">
                    @csrf
                    <x-textarea-input id="content" class="block mt-1 w-full" name="content" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('content')" class="mt-2" />
                    <div class="flex justify-end">
                        <x-primary-button class="mt-4" type="submit">
                            {{ __('Comment') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
            <div class="p-8 bg-white shadow sm:rounded-lg">

                <div class="comments space-y-4">
                    @forelse($blog->comments as $comment)
                    <div class="comment-item border-b pb-4">
                        <!-- Nama User -->
                        <h5 class="text-lg font-semibold text-gray-800">
                            {{ ucwords($comment->user->name) }}
                        </h5>

                        <!-- Waktu Komentar -->
                        <small class="text-sm text-gray-500">
                            {{ $comment->created_at->diffForHumans() }}
                        </small>

                        <!-- Isi Komentar -->
                        <p class="mt-2 text-gray-700">
                            {{ $comment->content }}
                        </p>

                        <!-- Button Reply -->
                        <div class="mt-4">
                            <button
                                class="text-blue-500 text-sm font-semibold hover:underline"
                                onclick="toggleReplyForm('{{ $comment->id }}')">
                                Reply
                            </button>
                        </div>

                        <!-- Form Reply (Dropdown) -->
                        <div id="reply-form-{{ $comment->id }}" class="hidden mt-4">
                            <form action="" method="POST">
                                @csrf
                                <textarea
                                    name="content"
                                    rows="3"
                                    class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                                    placeholder="Write your reply..."
                                    required></textarea>
                                <button
                                    type="submit"
                                    class="mt-2 bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                                    Post Reply
                                </button>
                            </form>
                        </div>

                        <!-- Balasan Komentar -->
                        @if($comment->replies->isNotEmpty())
                        <div class="replies mt-4 pl-4 border-l-2 border-gray-300 space-y-3">
                            @foreach($comment->replies as $reply)
                            <div class="reply-item">
                                <!-- Nama User Balasan -->
                                <h6 class="text-sm font-semibold text-gray-800">
                                    {{ ucwords($reply->user->name) }}
                                </h6>

                                <!-- Waktu Balasan -->
                                <small class="text-xs text-gray-500">
                                    {{ $reply->created_at->diffForHumans() }}
                                </small>

                                <!-- Isi Balasan -->
                                <p class="mt-1 text-gray-600">
                                    {{ $reply->content }}
                                </p>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                    @empty
                    <p class="text-gray-500">No comments yet. Be the first to comment!</p>
                    @endforelse
                </div>
            </div>

        </div>
    </div>

</x-app-layout>

<script>
    function toggleReplyForm(commentId) {
        const replyForm = document.getElementById(`reply-form-${commentId}`);
        if (replyForm.classList.contains('hidden')) {
            replyForm.classList.remove('hidden');
        } else {
            replyForm.classList.add('hidden');
        }
    }
</script>