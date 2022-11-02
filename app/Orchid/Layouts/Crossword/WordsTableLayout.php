<?php

namespace App\Orchid\Layouts\Crossword;

use App\Models\Crossword;
use App\Models\Lessons;
use App\Models\Word;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layout;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class WordsTableLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'words';

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
                ->render(function (Word $word) {
                    return $word->question;
                }),

            TD::make('word',__('Відповідь'))
                ->render(function (Word $word) {
                    return $word->word;
                }),

            TD::make('cells',__('Клітинки'))
                ->render(function (Word $word) {
                    return $word->cells;
                }),
            TD::make('bias',__('Відступ'))
                ->render(function (Word $word) {
                    return $word->bias;
                }),

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (Word $word) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([
                            ModalToggle::make('Редагувати')
                                ->modal('editWord')
                                ->modalTitle('Редагування елементу кросворду')
                                ->method('update')
                                ->parameters(['id'=>$word->id])
                                ->asyncParameters(['word'=>$word->id])
                                ->icon('pencil'),


                            Button::make(__('Видалити'))
                                ->icon('trash')
                                ->confirm(__('Чи впевнені '))
                                ->method('removeWord', [
                                    'id' => $word->id,
                                ]),
                        ]);
                }),
        ];
    }

}
