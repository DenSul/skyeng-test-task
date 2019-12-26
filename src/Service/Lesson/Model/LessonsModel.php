<?php

declare(strict_types = 1);

namespace src\Service\Lesson\Model;

use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Type;

/**
 * Я скучаю по https://laravel.com/api/5.0/Illuminate/Contracts/Support/Arrayable.html
 */
class LessonsModel
{
    /**
     * @Type("ArrayCollection<src\Service\Lesson\Model\LessonModel>")
     *
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
