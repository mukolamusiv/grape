<?php

namespace App\Orchid\Layouts\FindPair;

use App\Models\Lessons;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Rows;

class FindPairEditLayouts extends Rows
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
            Input::make('find_a_pair.title')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Назва завдання')),

            Input::make('find_a_pair.description')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Опис завдання'))
                ->placeholder(__('Про що це завдання')),
            Select::make('find_a_pair.lesson_id')
                ->fromModel(Lessons::class,'title')
                ->title(__('Назва уроку'))
                ->help('Оберіть урок для кого належить кросворд')
        ];
    }
}
