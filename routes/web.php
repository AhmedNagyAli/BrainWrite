<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('home');
// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/categories/{slug}', [CategoryController::class, 'show'])->name('category.show');
Route::get('/tags/{slug}', [TagController::class, 'show'])->name('tag.show');


//Auth routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');



Route::get('/posts/{slug}', [PostController::class, 'show'])->name('posts.show');
Route::post('/posts/visit/{slug}', [PostController::class, 'incrementVisitBySlug'])
    ->name('posts.incrementVisitBySlug')
    ->middleware('web');
