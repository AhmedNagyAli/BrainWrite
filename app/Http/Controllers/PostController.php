<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show($slug)
{
    $post = Post::with(['sections', 'user', 'category', 'tags'])
        ->where('slug', $slug)
        ->firstOrFail();

    //$post->increment('visited');

    // Get the most relevant recommended post
    $generalRecommendedPost = Post::query()
        ->where('id', '!=', $post->id) // Exclude current post
        ->where('category_id', $post->category_id) // Same category
        ->withCount(['tags' => function($query) use ($post) {
            $query->whereIn('id', $post->tags->pluck('id')); // Count matching tags
        }])
        ->with(['category', 'user'])
        ->orderByDesc('tags_count') // Posts with most matching tags first
        ->orderByDesc('visited')
        ->orderByDesc('created_at')
        ->first();

    // Fallback if no same-category post found
    if (!$generalRecommendedPost) {
        $generalRecommendedPost = Post::query()
            ->where('id', '!=', $post->id)
            ->withCount(['tags' => function($query) use ($post) {
                $query->whereIn('id', $post->tags->pluck('id'));
            }])
            ->with(['category', 'user'])
            ->orderByDesc('tags_count')
            ->orderByDesc('visited')
            ->orderByDesc('created_at')
            ->first();
    }

    // Get additional recommended posts (same category + same tags)
    $recommendedPosts = Post::whereHas('category', function($query) use ($post) {
            $query->where('id', $post->category_id);
        })
        ->orWhereHas('tags', function($query) use ($post) {
            $query->whereIn('id', $post->tags->pluck('id'));
        })
        ->where('id', '!=', $post->id)
        ->with(['category', 'user'])
        ->orderByDesc('visited')
        ->paginate(6);
    return view('pages.posts.show', [
        'post' => $post,
        'recommendedPosts' => $recommendedPosts,
        'generalRecommendedPost' => $generalRecommendedPost
    ]);
}

    public function incrementVisitBySlug($slug)
{
    $post = Post::where('slug', $slug)->firstOrFail();

    $sessionKey = 'visited_post_' . $slug;

    if (!session()->has($sessionKey)) {
        // Count the visit
        $post->increment('visited');

        // Mark this post as visited in current session
        session()->put($sessionKey, true);

        return response()->json([
            'status' => 'success',
            'new_count' => $post->visited
        ]);
    }

    return response()->json([
        'status' => 'already_counted',
        'message' => 'Visit already counted in this session'
    ], 200);
}

public function toggleSave(Post $post)
{
    $user = auth()->user();

    if ($user->savedPosts()->where('post_id', $post->id)->exists()) {
        $user->savedPosts()->detach($post->id);
        return response()->json(['status' => 'unsaved']);
    } else {
        $user->savedPosts()->attach($post->id);
        return response()->json(['status' => 'saved']);
    }
}


}
