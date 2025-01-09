@forelse($post->comments->where('parent_id', null)->sortByDesc('created_at') as $comment)
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


    <div id="parent-{{ $comment->id }}" class="replies mt-4 pl-4 border-l-2 border-gray-300 space-y-3">
        @include('post.partials.reply-list')
    </div>


    <div class="mt-4">
        <button
            class="text-blue-500 text-sm font-semibold hover:underline"
            onclick="toggleReplyForm('{{ $comment->id }}')">
            Reply
        </button>
    </div>

    <div id="reply-form-{{ $comment->id }}" class="hidden mt-4">
        <form class="reply-form" action="{{ route('comments.reply', ['post' => $post->id, 'comment' => $comment->id]) }}" method="POST">
            @csrf
            <x-text-input placeholder="Write your reply..." id="content-{{ $comment->id }}" class="block mt-1 mb-3 w-full" name="content" required />
            <div class="flex justify-end">
                <x-primary-button
                    type="submit">
                    Reply
                </x-primary-button>
            </div>
        </form>
    </div>

</div>
@empty
<p class="text-gray-500">No comments yet. Be the first to comment!</p>
@endforelse

<script>
    function toggleReplyForm(commentId) {
        const replyForm = document.getElementById(`reply-form-${commentId}`);
        replyForm.classList.toggle('hidden');
    }
    $(document).ready(function() {
        $('.reply-form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: $(this).serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#parent-' + response.parent_id).html(response.view);
                    $('#content-' + response.parent_id).val('');
                },
                error: function(xhr) {
                    console.error("Terjadi kesalahan:", xhr.responseText);
                }
            });
        });
    })
</script>