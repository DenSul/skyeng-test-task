<?php

declare(strict_types = 1);

namespace src\Service\Lesson\Model;

use JMS\Serializer\Annotation\Type;

class LessonModel
{
    /**
     * @Type("string")
     *
     * @var string
     */
    public $name;

    /**
     * @Type("string")
     *
     * @var string
     */
    public $date;

    /**
     * @Type("string")
     *
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
