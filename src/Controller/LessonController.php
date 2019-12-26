<?php

declare(strict_types = 1);

namespace src\Controller;

use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;
use src\Service\Lesson\LessonService;

class LessonController
{
    /**
     * @var LessonService
     */
    private $lessonService;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * LessonController constructor.
     *
     * @param LessonService $lessonService
     */
    public function __construct(LessonService $lessonService)
    {
        $this->lessonService = $lessonService;
        $this->serializer = SerializerBuilder::create()->build();
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
                header('content-type: application/xml');
                $response = $this->serializer->serialize($lessons, 'json');
                break;
            case 'xml':
            default:
                header('content-type: application/json');
                $response = $this->serializer->serialize($lessons, 'xml');
                break;
        }

        return $response;
    }
}
