<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\CommentPostCreateRequest;
use App\Http\Requests\Post\PostCreateRequest;
use App\Models\Blog;
use App\Models\Comment;
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
            'blogs' => Blog::all()->where('user_id', Auth::id())
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
        $post = Blog::create($validatedData);

        return redirect()->route('posts.index');
    }

    public function comment(CommentPostCreateRequest $request, $postId)
    {
        $comment = $request->validated();
        $comment['user_id'] = Auth::id();
        $comment['blog_id'] = $postId;
        Comment::create($comment);
        return redirect()->route('posts.show', $postId);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('post.show', [
            'blog' => Blog::findOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
