<?php

declare(strict_types = 1);

namespace src\Integration\Lessons\Decorator;

use Psr\Cache\CacheException;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\LoggerInterface;
use RuntimeException;
use src\Integration\Lessons\DataProviderInterface;
use Throwable;

class LoggerDecorator extends Decorator
{
    use LoggerAwareTrait;

    /**
     * @param DataProviderInterface $component
     * @param LoggerInterface       $logger
     */
    public function __construct(DataProviderInterface $component, LoggerInterface $logger)
    {
        $this->logger = $logger;

        parent::__construct($component);
    }

    /**
     * @param array|null $request
     *
     * @return array|null
     *
     */
    public function get(?array $request = null): ?array
    {
        try {
            $result = parent::get($request);
        } catch (RuntimeException $e) {
            $this->logger->critical('Error');
        } catch (CacheException $e) {
            $this->logger->alert('bad cache');
        } catch (Throwable $e) {
            $this->logger->alert('wtf????');
        }

        return $result ?? null;
    }
}
