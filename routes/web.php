<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SubscriptionController;
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


Route::get('/search/posts', [App\Http\Controllers\SearchController::class, 'searchPosts'])->name('search.posts');

Route::post('/subscribe', [SubscriptionController::class, 'store'])->name('subscribe');


Route::post('/posts/{post}/save', [PostController::class, 'toggleSave'])->middleware('auth')->name('posts.toggleSave');
Route::get('/saved-posts', [UserController::class, 'savedPosts'])->name('user.savedPosts');


Route::middleware(['auth'])->prefix('dashboard')->group(function () {
    Route::get('/profile', [UserController::class, 'editProfile'])->name('user.profile.edit');
    Route::get('/avatar', [UserController::class, 'editAvatar'])->name('user.avatar.edit');
    Route::get('/password', [UserController::class, 'editPassword'])->name('user.password.edit');
    Route::get('/saved', [UserController::class, 'savedPosts'])->name('user.saved');

    Route::post('/profile', [UserController::class, 'updateProfile'])->name('user.profile.update');
    Route::post('/avatar', [UserController::class, 'updateAvatar'])->name('user.avatar.update');
    Route::post('/password', [UserController::class, 'updatePassword'])->name('user.password.update');
});
