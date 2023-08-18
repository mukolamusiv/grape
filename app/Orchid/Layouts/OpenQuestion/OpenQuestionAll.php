<?php

namespace App\Orchid\Layouts\OpenQuestion;

use App\Models\OneWord;
use App\Models\OpenQuestion;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class OpenQuestionAll extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'open_question';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('question', __('Запитання'))
                ->sort()
                ->cantHide()
                ->filter(Input::make())
                ->render(function (OpenQuestion $open_question) {
                    return $open_question->question;
                }),

            TD::make('answer', __('Очікувана відповідь'))
                ->sort()
                ->cantHide()
                //->filter(Input::make())
                ->render(function (OpenQuestion $open_question) {
                    return $open_question->answer;
                }),
            TD::make('lesson', __('Урок'))
                ->sort()
                ->cantHide()
                ->filter(Input::make())
                ->render(function (OpenQuestion $open_question) {
                    return $open_question->lesson->title;
                }),
            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (OpenQuestion $open_question) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([
//                            Link::make(__('Переглянути'))
//                                ->route('find-pair.show', $find_a_Pair->id)
//                                ->icon('pen'),

                            Link::make(__('Редагувати'))
                                ->route('open-question.edit', $open_question->id)
                                ->icon('pencil'),

                            Button::make(__('Видалити'))
                                ->icon('trash')
                                ->confirm(__('Чи впевнені '))
                                ->method('remove', [
                                    'id' => $open_question->id,
                                ]),
                        ]);
                }),
        ];
    }
}

//  $table->unsignedBigInteger('lesson_id');
//            $table->string('question');
//            $table->string('answer');
