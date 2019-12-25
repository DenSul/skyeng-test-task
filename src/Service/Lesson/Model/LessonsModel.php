<?php

declare(strict_types = 1);

namespace src\Service\Lesson\Model;

/**
 * Я скучаю по https://laravel.com/api/5.0/Illuminate/Contracts/Support/Arrayable.html
 */
class LessonsModel
{
    /**
     * @var LessonsModel[]|null
     */
    public $lessons = [];

    /**
     * LessonsModel constructor.
     *
     * @param array|null $lessons
     */
    public function __construct(?array $lessons = null)
    {
        $this->lessons = $lessons;
    }
}
