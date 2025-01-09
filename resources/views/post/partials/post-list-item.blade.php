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
                     @include('post.partials.like-button')
                 </div>
                 <div class="inline-flex gap-2">
                     @include('post.partials.comment-button')
                     @if (Route::currentRouteName() == 'posts.index')
                     <span class="text-gray-500">|</span>
                     @include('post.partials.delete-button')
                     <a
                         href="{{ route('posts.edit', $post->id) }}"
                         class="text-gray-500 hover:text-indigo-500 ">
                         <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                             <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                         </svg>
                     </a>
                     @endif
                 </div>
             </div>
         </div>
     </div>
 </div>

 @endforeach