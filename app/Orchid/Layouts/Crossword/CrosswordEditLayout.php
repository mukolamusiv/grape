<?php

namespace App\Orchid\Layouts\Crossword;

use App\Models\Lessons;
use App\Models\Topic;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Rows;

class CrosswordEditLayout extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title;

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): iterable
    {
        return [
            Input::make('crossword.title')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Назва кросворду')),

            Input::make('crossword.description')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Опис кросворду'))
                ->placeholder(__('Про що цей кросворд')),
            Select::make('crossword.lesson_id')
                ->fromModel(Lessons::class,'title')
                ->title(__('Назва уроку'))
                ->help('Оберіть урок для кого належить кросворд')
        ];
    }
}
