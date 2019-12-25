<?php

namespace src\Integration\Lessons\Factory;

use src\Integration\Lessons\DataProviderInterface;

interface DataProviderFactoryInterface
{
    /**
     * Если прод окружение, то нужно завернуть в кэш-декоратор.
     *
     * @param string $host
     * @param string $user
     * @param string $password
     *
     * @return DataProviderInterface
     */
    public function create(string $host, string $user, string $password): DataProviderInterface;
}
