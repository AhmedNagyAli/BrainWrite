<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        // Load posts that belong to the category
        $posts = $category->posts()->with('user')->latest()->paginate(10);

        return view('pages.category', compact('category', 'posts'));
    }

    // Return categories as JSON for AJAX
    public function list(Request $request)
    {
        $categories = Category::select('name', 'slug')->take(10)->get();
        return response()->json($categories);
    }
}
