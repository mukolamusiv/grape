<?php

namespace App\Orchid\Layouts\OneWord;

use Orchid\Screen\Actions\Button;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Layouts\Rows;

class OneWordCreateWord extends Rows
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
            Input::make('word.title')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Заголовок')),

            Input::make('word.description')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Опис')),

            Input::make('word.text')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Текст завдання')),

            Input::make('word.word')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Слово-відповідь')),

            Upload::make('word.file')
                ->targetRelativeUrl()
                ->title('Зображення'),

//                Button::make('Зберегти зміни')
//                    ->method('save')
//                    ->icon('save')
        ];
    }
}
