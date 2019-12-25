<?php

declare(strict_types = 1);

namespace src\Controller;

use src\Service\Lesson\LessonService;

class LessonController
{
    /**
     * @var LessonService
     */
    private $lessonService;

    /**
     * LessonController constructor.
     *
     * @param LessonService $lessonService
     */
    public function __construct(LessonService $lessonService)
    {
        $this->lessonService = $lessonService;
    }

    /**
     * Получение списка уроков.
     *
     * @param int         $categoryId
     * @param string|null $format
     *
     * @return string
     */
    public function action(int $categoryId, ?string $format = 'json'): string
    {
        // Ух, боль. В ларке клево делать свои реквесты.
        // Ну или в симфе реквест-конвертор, который умеет валидировать. Может как-то через аннотации можно сделать.
        if ($categoryId <= 0 || ! preg_match('/\d{5}/', $categoryId)) {
            echo 'error';
            exit;
        }

        $lessons = $this->lessonService->getLessonsByCategoryId($categoryId);

        switch ($format) {
            case 'json':
                $response = 'hello';
                break;
            case 'xml':
            default:
                $response = 'ok';
                break;
        }

        return $response;
    }
}
