<?php

declare(strict_types = 1);

namespace src\Service\Lesson;

use src\Integration\Lessons\Factory\DataProviderFactoryInterface;
use src\Service\Lesson\Model\LessonModel;
use src\Service\Lesson\Model\LessonsModel;

class LessonService
{
    /**
     * @var DataProviderFactoryInterface
     */
    protected $client;

    /**
     * Service constructor.
     *
     * @param DataProviderFactoryInterface $factory
     */
    public function __construct(DataProviderFactoryInterface $factory)
    {
        $url      = getenv('SERVICE_NAME_HOST');
        $username = getenv('SERVICE_NAME_USER');
        $password = getenv('SERVICE_NAME_PASSWORD');

        $this->client = $factory->create($url, $username, $password);
    }

    /**
     * @param int $categoryId
     *
     * @return LessonsModel
     */
    public function getLessonsByCategoryId(int $categoryId): LessonsModel
    {
        $lessonsRaw = $this->client->get(['categoryId' => $categoryId]);
        $lessons    = [];

        foreach ($lessonsRaw as $lesson) {
            $lessons[] = new LessonModel(
                $lesson['name'],
                $lesson['date'],
                $lesson['teacher']
            );
        }

        return new LessonsModel($lessons);
    }
}
