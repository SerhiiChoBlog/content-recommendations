<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
            h1 {
                text-align: center;
            }
            li {
                margin-bottom: 10px;
            }
        </style>
    </head>
    <body>
        <h1>Recommendation Posts</h1>

        <ul>
            @forelse ($posts as $post)
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
