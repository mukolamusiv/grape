<?php

namespace App\Orchid\Layouts\Topic;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Layouts\Rows;

class TopicEditLayout extends Rows
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
            Input::make('topic.title')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Назва'))
                ->placeholder(__('Назва уроку')),

            Input::make('topic.description')
                ->type('text')
                ->max(255)
                ->title(__('Опис теми'))
                ->placeholder(__('Опис теми')),

        ];
    }
}
