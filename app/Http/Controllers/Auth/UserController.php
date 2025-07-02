<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function savedPosts()
{
    $posts = auth()->user()->savedPosts()->latest()->paginate(10);
    return view('users.saved-posts', compact('posts'));
}

}
