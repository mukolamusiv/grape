<?php

namespace App\Orchid\Layouts\OpenQuestion;

use App\Models\Lessons;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Rows;

class OpenQuestionCreate extends Rows
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
            Input::make('question')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Текст запитання')),

            Input::make('answer')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Очікувана відповідь')),

            Select::make('lesson_id')
                ->fromModel(Lessons::class,'title')
                ->title(__('Назва уроку'))
                ->help('Оберіть урок для кого належить кросворд'),

        ];
    }
}
