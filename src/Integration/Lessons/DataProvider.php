<?php

declare(strict_types = 1);

namespace src\Integration\Lessons;

use RuntimeException;

class DataProvider implements DataProviderInterface
{
    /**
     * @var string
     */
    private $host;

    /**
     * @var string
     */
    private $user;

    /**
     * @var string
     */
    private $password;

    /**
     * DataProvider constructor.
     *
     * @param string $host
     * @param string $user
     * @param string $password
     */
    public function __construct(string $host, string $user, string $password)
    {
        $this->host     = $host;
        $this->user     = $user;
        $this->password = $password;
    }

    /**
     * @param array|null $request
     *
     * @return array|null
     * @throws RuntimeException
     */
    public function get(?array $request): ?array
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->host . '?' . http_build_query($request));
        curl_setopt($ch, CURLOPT_USERPWD, $this->user . ':' . $this->password);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $output = curl_exec($ch);

        if(curl_errno($ch)){
            throw new RuntimeException(curl_error($ch));
        }

        curl_close($ch);

        return json_decode($output, true);
    }
}
