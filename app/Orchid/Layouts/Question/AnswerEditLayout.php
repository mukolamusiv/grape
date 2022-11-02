<?php

namespace App\Orchid\Layouts\Question;

use App\Models\Lessons;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Rows;

class AnswerEditLayout extends Rows
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
            Input::make('answer.text')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Варіант відповіді на запитання')),

            CheckBox::make('answer.correct')
                ->value(1)
                ->title('Вірна відповідь')
                ->help('Якщо позначено тоді вірна')
        ];
    }
}
