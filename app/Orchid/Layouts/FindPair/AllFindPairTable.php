<?php

namespace App\Orchid\Layouts\FindPair;

use App\Models\Crossword;
use App\Models\Find_a_Pair;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class AllFindPairTable extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'find_a_pair';

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
                ->render(function (Find_a_Pair $find_a_Pair) {
                    return $find_a_Pair->title;
                }),
            TD::make('description', __('Опис'))
                ->sort()
                ->cantHide()
                ->filter(Input::make())
                ->render(function (Find_a_Pair $find_a_Pair) {
                    return $find_a_Pair->description;
                }),
            TD::make('lesson', __('Урок'))
                ->sort()
                ->cantHide()
                ->filter(Input::make())
                ->render(function (Find_a_Pair $find_a_Pair) {
                    return $find_a_Pair->lesson->title;
                }),
            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (Find_a_Pair $find_a_Pair) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([
//                            Link::make(__('Переглянути'))
//                                ->route('find-pair.show', $find_a_Pair->id)
//                                ->icon('pen'),

                            Link::make(__('Редагувати'))
                                ->route('find-pair.show', $find_a_Pair->id)
                                ->icon('pencil'),

                            Button::make(__('Видалити'))
                                ->icon('trash')
                                ->confirm(__('Чи впевнені що хочете видалити? '))
                                ->method('removeFindPair', [
                                    'id' => $find_a_Pair->id,
                                ]),
                        ]);
                }),
        ];
    }
}
