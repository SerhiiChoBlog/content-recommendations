<?php

use App\Models\Post;
use App\Recommendations\Post\Filters\ExclusionFilter;
use App\Recommendations\Post\Filters\PostTagsFilter;
use App\Recommendations\Post\RecommendationSystem;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $posts = Post::with('tags')->inRandomOrder()->limit(50)->get();

    return view('welcome', compact('posts'));
});

const DAY = 86400;

Route::get('/posts/{post}', function (Post $post) {
    $recommendations = Cache::remember("post-{$post->id}-recommendations", DAY, function () use ($post) {
        return (new RecommendationSystem(limit: 3))
            ->pipe(new ExclusionFilter(excludeIds: [$post->id]))
            ->pipe(new PostTagsFilter(post: $post))
            ->get();
    });

    return view('post', compact('post', 'recommendations'));
})->name('posts.show');
