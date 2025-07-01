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
            ->paginate(5);
        $sportsPosts = Post::with('user', 'category', 'tags')
                ->where('status', 'published')
                ->whereHas('tags', fn($q) => $q->where('slug', 'sports'))
                ->orderByDesc('published_at')
                ->paginate(5, ['*'], 'sports_page'); // Unique pagination name


        $techPosts = Post::with('user', 'category', 'tags')
    ->where('status', 'published')
    ->where(function ($query) {
        $query->whereHas('category', fn($q) =>
            $q->where('slug', 'technology')
        )->orWhereHas('tags', fn($q) =>
            $q->where('slug', 'technology')
        );
    })
            ->latest()
            ->paginate(10, ['*'], 'tech_page'); // Unique pagination name
        $featuredIds = $featuredPosts->pluck('id');

        $latestPosts = Post::query()
        ->where('status', 'published')
        ->latest()->paginate(3);


        $mostVisited = Post::orderBy('visited', 'desc')
        ->latest()
        ->paginate(5);
        $posts = Post::with('user', 'category')
                     ->where('status', 'published')
                     ->whereNotIn('id', $featuredIds)
                     ->orderByDesc('published_at')
                     ->paginate(10);

if (request()->ajax()) {
    if (request()->has('sports_page')) {
        return view('components.sections.sports', ['sportsPosts' => $sportsPosts])->render();
    }
    if (request()->has('tech_page')) {
        return view('components.sections.tech', ['techPosts' => $techPosts])->render();
    }

    return view('components.sections.main', ['posts' => $posts])->render();
}

return view('pages.home', compact('posts', 'featuredPosts', 'mostVisited', 'sportsPosts','latestPosts','techPosts'));
    }
}
