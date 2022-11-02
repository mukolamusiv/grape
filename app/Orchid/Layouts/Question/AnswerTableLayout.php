<?php

namespace App\Orchid\Layouts\Question;

use App\Models\Answer;
use App\Models\Word;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class AnswerTableLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'answer';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('text', __('Відповідь'))
                ->sort()
                ->cantHide()
                ->filter(Input::make())
                ->render(function (Answer $answer) {
                    return $answer->text;
                }),

            TD::make('word',__('Відповідь'))
                ->render(function (Answer $answer) {
                    return $answer->correct;
                }),

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (Answer $answer) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([
                            ModalToggle::make('Редагувати')
                                ->modal('editAnswer')
                                ->modalTitle('Редагування відповіді на запитання')
                                ->method('editAnswer')
                                ->parameters(['answer'=>$answer->id])
                                ->asyncParameters(['answer'=>$answer->id])
                                ->icon('pencil'),


                            Button::make(__('Видалити'))
                                ->icon('trash')
                                ->confirm(__('Чи впевнені '))
                                ->method('removeAnswer', [
                                    'id' => $answer->id,
                                ]),
                        ]);
                }),
        ];
    }
}
