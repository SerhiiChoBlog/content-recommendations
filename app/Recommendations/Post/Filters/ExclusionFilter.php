<?php

declare(strict_types=1);

namespace App\Recommendations\Post\Filters;

use App\Recommendations\Post\DataStream;

class ExclusionFilter implements Filter
{
    public function __construct(private readonly array $excludeIds)
    {
    }

    public function process(DataStream $stream): DataStream
    {
        $stream->excludeIds->push(...$this->excludeIds);
        return $stream;
    }
}
