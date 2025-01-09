<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\CommentPostCreateRequest;
use App\Http\Requests\Post\PostCreateRequest;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Like;
use Illuminate\Contracts\View\View;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('post.postList',  [
            'posts' => Post::all()->where('user_id', Auth::id())
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostCreateRequest $request)
    {

        $validatedData = $request->validated();
        $validatedData['user_id'] = Auth::id();
        $post = Post::create($validatedData);
        $request->session()->flash('success', 'Post has been created successfully!');
        return redirect()->route('posts.index');
    }

    public function comment(CommentPostCreateRequest $request, $postId)
    {
        $comment = $request->validated();
        $comment['user_id'] = Auth::id();
        $comment['post_id'] = $postId;
        Comment::create($comment);
        return redirect()->route('posts.show', $postId);
    }

    public function like(Request $request, $postId)
    {
        $post = Post::findOrFail($postId);
        $user = $request->user();

        if ($post->likes()->where('user_id', $user->id)->exists()) {
            $post->likes()->where('user_id', $user->id)->delete();
        } else {
            $post->likes()->create(['user_id' => $user->id]);
        }

        return response()->json([
            'view' => view('post.partials.like-button', compact('post'))->render()
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('post.show', [
            'post' => Post::findOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('post.edit', [
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Post::findOrFail($id)->update($request->all());
        $request->session()->flash('success', 'Post has been updated successfully!');
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Post $post)
    {

        if (!$post->delete()) {
            $request->session()->flash('fail', 'Post was not deleted!');
        }

        $request->session()->flash('success', 'Post has been deleted successfully!');
        return redirect()->route('posts.index');
    }
}
