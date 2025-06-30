<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function searchPosts(Request $request)
{
    $query = $request->input('query');

    $results = \App\Models\Post::query()
        ->where('title', 'like', "%{$query}%")
        ->orWhere('meta_title', 'like', "%{$query}%")
        ->orWhere('meta_description', 'like', "%{$query}%")
        ->limit(10)
        ->get(['id', 'title', 'slug', 'image']); // 👈 Add 'image' here

    return response()->json($results);
}
}
