<?php

namespace App\Orchid\Layouts\Question;

use App\Models\Lessons;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Rows;

class QuestionEditLayout extends Rows
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
            Input::make('question.title')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Назва або тема запитання')),

            Input::make('question.description')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Текст запитання'))
                ->placeholder(__('Скільки є Святих Таїнств?')),

            Input::make('question.point')
                ->type('number')
                ->max(255)
                ->required()
                ->title(__('Бали')),


            Select::make('question.lesson_id')
                ->fromModel(Lessons::class,'title')
                ->title(__('Належить до уроку'))
                ->help('Оберіть урок для кого належить запитання')
        ];
    }
}
