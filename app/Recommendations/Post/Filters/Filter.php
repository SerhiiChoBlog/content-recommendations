<?php

declare(strict_types=1);

namespace App\Recommendations\Post\Filters;

use App\Recommendations\Post\DataStream;

interface Filter
{
    public function process(DataStream $stream): DataStream;
}
