<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('home');
// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/categories/{slug}', [CategoryController::class, 'show'])->name('category.show');
//Route::get('/ajax/categories', [CategoryController::class, 'list'])->name('categories.ajax');
