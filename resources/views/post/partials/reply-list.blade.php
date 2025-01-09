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