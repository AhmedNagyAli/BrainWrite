<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function show($slug)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();
        $currentTag = request()->routeIs('tag.show') ? Tag::where('slug', request()->route('slug'))->first() : null;
        $posts = $tag->posts()->with('user', 'category')->latest()->paginate(10);

        return view('pages.tag', compact('tag', 'posts','currentTag'));
    }
}
