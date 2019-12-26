<?php

namespace src\Integration\Lessons;

namespace src\Integration\Lessons;

use Psr\Cache\CacheException;
use RuntimeException;
use Throwable;

interface DataProviderInterface
{
    /**
     * @param array|null $request
     *
     * @return array|null
     */
    public function get(?array $request): ?array;
}
