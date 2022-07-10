<?php

namespace App\Orchid\Layouts\Topic;

use App\Models\Lessons;
use App\Models\Topic;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class TopicLessonsLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'lessons';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('title', __('Назва'))
                //->sort()
                ->cantHide()
                ->filter(Input::make())
                ->render(function (Lessons $lessons) {
                    return $lessons->title;
                }),
            TD::make('description', __('Опис'))
                //->sort()
                ->cantHide()
                ->filter(Input::make())
                ->render(function (Lessons $lessons) {
                    return $lessons->description;
                }),
        ];
    }
}
