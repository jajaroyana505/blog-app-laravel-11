 @foreach ($posts as $post )

 <div class="pt-3">
     <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
         <div class="p-4 bg-white shadow sm:rounded-lg">
             <div class="p-4 border-b">
                 <h1 class="text-2xl font-medium">{{ $post->title }}</h1>
                 <p class="text-slate-600">Author: {{ ucwords($post->user->name)  }}</p>
                 <p class="text-slate-800 my-2">{{ substr($post->content, 0, 250) }} <a class="text-blue-600" href="{{ route('posts.show', $post->id) }}">... read more</a></p>
                 <div class="flex justify-end">
                     <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                 </div>
             </div>
             <div class="p-4 flex justify-between">
                 <div id="like-section-{{ $post->id }}">
                     @include('post.partials.like-button', ['post' => $post])
                 </div>
                 <div class="inline-flex gap-2">
                     @include('post.partials.comment-button', ['post' => $post])
                 </div>
             </div>
         </div>
     </div>
 </div>

 @endforeach