<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
    <div class="p-8 bg-white shadow sm:rounded-lg">
        <form id="comment-form" method="POST" action="{{ route('comments.store', $post->id) }}">
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
        <!-- Comments List -->
        <div id="comments-list" class="space-y-4">
            @include('post.partials.comment-list')
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#comment-form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: $(this).serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#comments-list').html(response.view);
                    $('#content').val('');
                },
                error: function(xhr) {
                    console.error("Terjadi kesalahan:", xhr.responseText);
                }
            });
        });
    })
</script>