<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredPosts = Post::featured()
            ->latest()
            ->limit(value: 3)
            ->paginate(3);

        $featuredIds = $featuredPosts->pluck('id');


        $mostVisited = Post::orderBy('visited', 'desc')
        ->latest()
        ->paginate(5);
        $posts = Post::with('user', 'category')
                     ->where('status', 'published')
                     ->whereNotIn('id', $featuredIds)
                     ->orderByDesc('published_at')
                     ->paginate(10);

        return view('pages.home', compact('posts','featuredPosts','mostVisited'));
    }
}
