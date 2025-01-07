@props(['post'])
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
    <div class="p-8 bg-white shadow sm:rounded-lg">
        <form method="POST" action="{{ route('posts.comment', $post->id) }}">
            @csrf
            <x-textarea-input placeholder="Write your comment..." id="content" class="block mt-1 w-full" name="content" required />
            <x-input-error :messages="$errors->get('content')" class="mt-2" />
            <div class="flex justify-end">
                <x-primary-button class="mt-4" type="submit">
                    {{ __('Comment') }}
                </x-primary-button>
            </div>
        </form>
        <p class="text-xl pb-2 font-semibold text-slate-800 mb-3 border-b">Comments :</p>

        <div class="comments space-y-4">
            @forelse($post->comments as $comment)
            <div class="comment-item border-b pb-4">

                <h5 class="text-lg font-semibold text-gray-800">
                    {{ ucwords($comment->user->name) }}
                </h5>


                <small class="text-sm text-gray-500">
                    {{ $comment->created_at->diffForHumans() }}
                </small>

                <p class="mt-2 text-gray-700">
                    {{ $comment->content }}
                </p>


                <div class="mt-4">
                    <button
                        class="text-blue-500 text-sm font-semibold hover:underline"
                        onclick="toggleReplyForm('{{ $comment->id }}')">
                        Reply
                    </button>
                </div>


                <div id="reply-form-{{ $comment->id }}" class="hidden mt-4">
                    <form action="" method="POST">
                        @csrf
                        <x-text-input placeholder="Write your reply..." id="content_{{ $comment->id }}" class="block mt-1 mb-3 w-full" name="content" required />
                        <div class="flex justify-end">

                            <x-primary-button
                                type="submit">
                                Reply
                            </x-primary-button>
                        </div>
                    </form>
                </div>


                @if($comment->replies->isNotEmpty())
                <div class="replies mt-4 pl-4 border-l-2 border-gray-300 space-y-3">
                    @foreach($comment->replies as $reply)
                    <div class="reply-item">

                        <h6 class="text-sm font-semibold text-gray-800">
                            {{ ucwords($reply->user->name) }}
                        </h6>


                        <small class="text-xs text-gray-500">
                            {{ $reply->created_at->diffForHumans() }}
                        </small>
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