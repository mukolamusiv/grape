<?php

namespace App\Orchid\Layouts\Question;

use App\Models\Lessons;
use App\Models\Question;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class QuestionTableLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'questions';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('title', __('Назва'))
                ->sort()
                ->cantHide()
                ->filter(Input::make())
                ->render(function (Question $question) {
                    return $question->title;
                }),
            TD::make('description', __('Запитання'))
                ->sort()
                ->filter(Input::make())
                ->render(function (Question $question) {
                    return $question->description;
                }),
//            TD::make('text', __('Текст уроку'))
//                ->sort()
//                ->filter(Input::make())
//                ->render(function (Lessons $lessons) {
//                    return $lessons->text;
//                }),
            TD::make('points', __('Кількість балів'))
                ->sort()
                ->filter(Input::make())
                ->render(function (Question $question) {
                    return $question->point;
                })->width('150px'),

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (Question $question) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([
                            Link::make(__('Переглянути'))
                                ->route('question.edit', $question->id)
                                ->icon('pen'),

                            Button::make(__('Видалити'))
                                ->icon('trash')
                                ->confirm(__('Ви хочете видалити запитання'))
                                ->method('removeQuestion', [
                                    'id' => $question->id,
                                ]),
                        ]);
                }),
        ];
    }
}
