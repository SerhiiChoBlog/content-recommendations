<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $post->title }}</title>
        <style>

        </style>
    </head>
    <body>
        <a href="/">Back</a>

        <h1>{{ $post->title }}</h1>
        <h3>Tags: {{ $post->tags->pluck('name')->join(', ') }}</h3>

        <p>{{ $post->content }}</p>

        <hr>

        <h2>Recommendations</h2>

        <ul>
            @forelse($recommendations as $post)
                <li>
                    <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                    <b>[{{ $post->tags->pluck('name')->join(', ') }}]</b>
                </li>
            @empty
                <li>No posts yet!</li>
            @endforelse
        </ul>
    </body>
</html>
