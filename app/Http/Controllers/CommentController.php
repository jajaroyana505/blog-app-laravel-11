<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\CrateCommentRequest;
use App\Http\Requests\Comment\ReplyCommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    public function store(CrateCommentRequest $request, Post $post)
    {
        $comment = $request->validated();
        $comment['user_id'] = Auth::id();
        $comment['post_id'] = $post->id;
        Comment::create($comment);
        return response()->json([
            'view' => view('post.partials.comment-list', compact('post'))->render(),
        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function reply(ReplyCommentRequest $request, Post $post, Comment $comment)
    {
        $newComment = $request->validated();
        $newComment['user_id'] = Auth::id();
        $newComment['post_id'] = $post->id;
        $newComment['parent_id'] = $comment->id;
        Comment::create($newComment);
        return response()->json([
            'view' => view('post.partials.reply-list', compact('comment'))->render(),
            'parent_id' => $comment->id,
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
