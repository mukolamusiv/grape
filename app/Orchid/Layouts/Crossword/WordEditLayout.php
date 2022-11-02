<?php

namespace App\Orchid\Layouts\Crossword;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\TD;

class WordEditLayout extends Rows
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
//            Input::make('words.id')
//                ->type('hidden'),

            Input::make('words.question')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Запитання'))
                ->placeholder(__('Введіть запитання')),

            Input::make('words.word')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Відповідь'))
                ->placeholder(__('Точна відповідь')),

            Input::make('words.cells')
                ->type('number')
                ->max(255)
                ->required()
                ->title(__('Кількість клітинок')),

            Input::make('words.bias')
                ->type('number')
                ->max(255)
                ->required()
                ->title(__('Відступ від лівого краю')),

        ];
    }
}
