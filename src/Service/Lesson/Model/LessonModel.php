<?php

declare(strict_types = 1);

namespace src\Service\Lesson\Model;

class LessonModel
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $date;

    /**
     * @var string|null
     */
    public $teacherName;

    /**
     * LessonModel constructor.
     *
     * @param string      $name
     * @param string      $date
     * @param string|null $teacherName
     */
    public function __construct(string $name, string $date, ?string $teacherName)
    {
        $this->name        = $name;
        $this->date        = $date;
        $this->teacherName = $teacherName;
    }
}
