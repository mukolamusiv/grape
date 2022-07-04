<?php

namespace App\Orchid\Layouts\Lessons;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Layouts\Rows;

class LessonsEditLayout extends Rows
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
            Input::make('lessons.title')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Назва'))
                ->placeholder(__('Назва уроку')),

            Input::make('lessons.description')
                ->type('text')
                ->max(255)
                ->title(__('Опис уроку'))
                ->placeholder(__('Опис уроку')),

            Quill::make('lessons.text')
                ->type('text')
                ->required()
                ->title(__('Текст уроку'))
                ->placeholder(__('Текст уроку')),
        ];
    }
}
