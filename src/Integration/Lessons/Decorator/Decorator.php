<?php

declare(strict_types = 1);

namespace src\Integration\Lessons\Decorator;

use src\Integration\Lessons\DataProviderInterface;

class Decorator implements DataProviderInterface
{
    /**
     * @var DataProviderInterface
     */
    protected $component;

    public function __construct(DataProviderInterface $component)
    {
        $this->component = $component;
    }

    /**
     * @param array|null $request
     *
     * @return array|null
     */
    public function get(?array $request = null): ?array
    {
        return $this->component->get($request);
    }
}
