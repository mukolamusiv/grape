<?php

namespace App\Orchid\Layouts\OneWord;

use App\Models\Find_a_Pair;
use App\Models\OneWord;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class OneWordTableAll extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'one_word';

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
                ->render(function (OneWord $oneWord) {
                    return $oneWord->title;
                }),
            TD::make('description', __('Опис'))
                ->sort()
                ->cantHide()
                ->filter(Input::make())
                ->render(function (OneWord $oneWord) {
                    return $oneWord->description;
                }),
            TD::make('lesson', __('Урок'))
                ->sort()
                ->cantHide()
                ->filter(Input::make())
                ->render(function (OneWord $oneWord) {
                    return $oneWord->lesson->title;
                }),
            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (OneWord $oneWord) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([
//                            Link::make(__('Переглянути'))
//                                ->route('find-pair.show', $find_a_Pair->id)
//                                ->icon('pen'),

                            Link::make(__('Редагувати'))
                                ->route('one-word.edit', $oneWord->id)
                                ->icon('pencil'),

                            Button::make(__('Видалити'))
                                ->icon('trash')
                                ->confirm(__('Чи впевнені '))
                                ->method('remove', [
                                    'id' => $oneWord->id,
                                ]),
                        ]);
                }),

        ];
    }
}
