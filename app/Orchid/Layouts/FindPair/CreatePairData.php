<?php

namespace App\Orchid\Layouts\FindPair;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Layouts\Rows;

class CreatePairData extends Rows
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
            Input::make('data_first.title')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Заголовок першої частини пари'))
                ->placeholder(__('Введіть заголовок')),

            Input::make('data_first.description')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Опис першої частини пари'))
                ->placeholder(__('Опис')),

            Input::make('data_first.text')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Текст першої частини пари')),

            Upload::make('data_first.file')
                ->targetRelativeUrl()
                ->title('Зображення'),

//            Input::make('data_first.cells')
//                ->type('number')
//                ->max(255)
//                ->title(__('Кількість клітинок')),





            Input::make('data_second.title')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Заголовок другої частини пари'))
                ->placeholder(__('Введіть заголовок')),

            Input::make('data_second.description')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Опис другої частини пари'))
                ->placeholder(__('Опис')),

            Input::make('data_second.text')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Текст другої частини пари')),

            Upload::make('data_second.file')
                ->maxFiles(1)
                //->targetRelativeUrl()
                ->title('Зображення'),
        ];
    }
}
