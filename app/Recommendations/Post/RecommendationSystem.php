<?php

declare(strict_types=1);

namespace App\Recommendations\Post;

use App\Models\Post;
use App\Recommendations\Post\Filters\Filter;
use Illuminate\Support\Collection;

class RecommendationSystem
{
    private DataStream $stream;

    public function __construct(int $limit)
    {
        $this->stream = new DataStream(
            items: collect(),
            excludeIds: collect(),
            remaining: $limit,
            limit: $limit,
        );
    }

    public function pipe(Filter $filter): self
    {
        if ($this->stream->needsMoreContent()) {
            $this->stream = $filter->process($this->stream);
        }

        return $this;
    }

    public function get(): Collection
    {
        if ($this->stream->needsMoreContent()) {
            $randomPosts = $this->getRandomPosts();
             return $this->stream->items->merge($randomPosts);
        }

        return $this->stream->items->take($this->stream->limit);
    }

    /**
     * @return Collection<int, Post>
     */
    private function getRandomPosts(): Collection
    {
        $result = Post::with('tags')
            ->where('is_published', true)
            ->whereNotIn('id', $this->stream->excludeIds)
            ->inRandomOrder()
            ->limit($this->stream->remaining)
            ->get();

        $remainingPosts = $this->stream->remaining - $result->count();

        if ($remainingPosts === 0) {
            return $result;
        }

        $additionalPosts = Post::with('tags')
            ->where('is_published', true)
            ->inRandomOrder()
            ->whereNotIn('id', $result->pluck('id'))
            ->limit($remainingPosts)
            ->get();

        return $result->push(...$additionalPosts);
    }
}
