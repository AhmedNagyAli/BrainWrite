<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show($slug)
    {

        $post = Post::with(['sections', 'user', 'category'])->where('slug', $slug)->firstOrFail();
        $post->increment('visited');
        return view('pages.posts.show', compact('post'));
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

}
