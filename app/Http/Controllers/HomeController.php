<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredPosts = Post::featured()
            ->latest('published_at')
            ->limit(5)
            ->get();
        $posts = Post::with('user', 'category')
                     ->where('status', 'published')
                     ->orderByDesc('published_at')
                     ->paginate(10);

        return view('pages.home', compact('posts','featuredPosts'));
    }
}
