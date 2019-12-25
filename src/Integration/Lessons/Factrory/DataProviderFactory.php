<?php

declare(strict_types = 1);

namespace src\Integration\Lessons\Factory;

use Psr\Cache\CacheItemPoolInterface;
use Psr\Log\LoggerInterface;
use src\Integration\Lessons\DataProvider;
use src\Integration\Lessons\DataProviderInterface;
use src\Integration\Lessons\Decorator\CacheDecorator;
use src\Integration\Lessons\Decorator\LoggerDecorator;

class DataProviderFactory
{
    /**
     * @var CacheItemPoolInterface
     */
    private $cache;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * DataProviderFactory constructor.
     *
     * @param CacheItemPoolInterface $cache
     * @param LoggerInterface        $logger
     */
    public function __construct(CacheItemPoolInterface $cache, LoggerInterface $logger)
    {
        $this->cache  = $cache;
        $this->logger = $logger;
    }

    /**
     * @param string $host
     * @param string $user
     * @param string $password
     *
     * @return DataProviderInterface
     */
    public function create(string $host, string $user, string $password): DataProviderInterface
    {
        $instance = new DataProvider($host, $user, $password);
        if (getenv('APP_ENV') === 'production') {
            $instance = new CacheDecorator($instance, $this->cache);
        }

        return new LoggerDecorator($instance, $this->logger);
    }
}
