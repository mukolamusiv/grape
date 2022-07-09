<?php

namespace App\Orchid\Layouts\Lessons;

use App\Models\Lessons;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Screen\Fields\Input;

class LessonsListLayout extends Table
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
                ->sort()
                ->cantHide()
                ->filter(Input::make())
                ->render(function (Lessons $lessons) {
                    return $lessons->title;
                }),
            TD::make('description', __('Опис'))
                ->sort()
                ->filter(Input::make())
                ->render(function (Lessons $lessons) {
                    return $lessons->description;
                }),
//            TD::make('text', __('Текст уроку'))
//                ->sort()
//                ->filter(Input::make())
//                ->render(function (Lessons $lessons) {
//                    return $lessons->text;
//                }),
            TD::make('points', __('Кількість балів'))
                ->sort()
                ->filter(Input::make())
                ->render(function (Lessons $lessons) {
                    return $lessons->points;
                })->width('150px'),
            TD::make('level', __('Рівень'))
                ->sort()
                ->filter(Input::make())
                ->render(function (Lessons $lessons) {
                    return $lessons->level;
                })->width('150px'),
        ];
    }
}
