<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show($slug)
    {
        $post = Post::with(['sections', 'user', 'category'])->where('slug', $slug)->firstOrFail();

        return view('pages.posts.show', compact('post'));
    }
}
