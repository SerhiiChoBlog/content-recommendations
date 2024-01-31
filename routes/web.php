<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $posts = Post::with('tags')->inRandomOrder()->limit(50)->get();

    return view('welcome', compact('posts'));
});

Route::get('/posts/{post}', function (Post $post) {
    return view('post', compact('post'));
})->name('posts.show');
