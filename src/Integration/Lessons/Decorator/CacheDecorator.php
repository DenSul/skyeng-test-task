<?php

declare(strict_types = 1);

namespace src\Integration\Lessons\Decorator;

use DateTime;
use Psr\Cache\CacheItemPoolInterface;
use src\Integration\Lessons\DataProviderInterface;

class CacheDecorator extends Decorator
{
    protected const CACHE_PREFIX = 'service_name_';

    /**
     * @var CacheItemPoolInterface
     */
    private $cache;

    /**
     * @param DataProviderInterface  $component
     * @param CacheItemPoolInterface $cache
     */
    public function __construct(DataProviderInterface $component, CacheItemPoolInterface $cache)
    {
        $this->cache = $cache;
        parent::__construct($component);
    }

    public function get(?array $request = null): ?array
    {
        $result    = null;
        $cacheItem = $this->cache->getItem($this->getCacheKey($request));

        if ($cacheItem->isHit()) {
            $result = $cacheItem->get();
        } else {
            $result = parent::get($request);

            if ($result !== null) {
                $cacheItem->set($result)->expiresAt((new DateTime)->modify('+1 day'));
                $this->cache->save($cacheItem);
            }
        }

        return $result;
    }

    /**
     * @param array|null $request
     *
     * @return string
     */
    private function getCacheKey(?array $request): string
    {
        ksort($request);

        return md5(static::CACHE_PREFIX . implode('.', $request));
    }
}
