<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index()
    {
        return view('post.postList',  [
            'posts' => Post::all()
        ]);
    }
}
