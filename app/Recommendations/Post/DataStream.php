<?php

declare(strict_types=1);

namespace App\Recommendations\Post;

use App\Models\Post;
use Illuminate\Support\Collection;

class DataStream
{
    /**
     * @param Collection<int, Post> $items
     * @param Collection<int, Post> $excludeIds
     */
    public function __construct(
        public Collection $items,
        public Collection $excludeIds,
        public int $remaining,
        public readonly int $limit,
    ) {
    }

    public function needsMoreContent(): bool
    {
        $this->remaining = $this->limit - $this->items->count();
        return $this->remaining > 0;
    }
}
