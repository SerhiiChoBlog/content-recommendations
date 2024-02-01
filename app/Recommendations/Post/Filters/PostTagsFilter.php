<?php

declare(strict_types=1);

namespace App\Recommendations\Post\Filters;

use App\Models\Post;
use App\Models\Tag;
use App\Recommendations\Post\DataStream;
use Illuminate\Support\Collection;

class PostTagsFilter implements Filter
{
    public function __construct(private readonly Post $post)
    {
    }

    public function process(DataStream $stream): DataStream
    {
        $stream->excludeIds->push($this->post->id);

        $tags = $this->post->tags()->select('id')->get();

        foreach ($tags as $tag) {
            $posts = $this->getTagPosts($tag, $stream);

            $stream->excludeIds->push(...$posts->pluck('id'));
            $stream->items->push(...$posts);

            if (!$stream->needsMoreContent()) {
                break;
            }
        }

        return $stream;
    }

    /**
     * @return Collection<int, Post>
     */
    private function getTagPosts(Tag $tag, DataStream $stream): Collection
    {
        return $tag->posts()
            ->whereNotIn('id', $stream->excludeIds)
            ->limit($stream->remaining)
            ->get()
            ->shuffle();
    }
}
