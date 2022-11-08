<?php


namespace App\DTO\BuildDTO\ComponentLessonDTO;


use App\Models\Lessons;
use Illuminate\Support\Collection;

class ComponentCrosswordDTO implements \App\DTO\BuildDTO\ComponentInterfaceDTO
{

    /**
     * @inheritDoc
     */
    public function object(): array
    {
        // TODO: Implement object() method.
    }

    /**
     * @inheritDoc
     */
    public function find()
    {
        // TODO: Implement find() method.
    }

    /**
     * @inheritDoc
     */
    public function __construct(Collection $lesson, int $user_id)
    {
    }

    /**
     * @inheritDoc
     */
    public function setAnswer($request): bool
    {
        // TODO: Implement setAnswer() method.
    }

    /**
     * @inheritDoc
     */
    public function getCompleted(): bool
    {
        // TODO: Implement getCompleted() method.
    }
}
