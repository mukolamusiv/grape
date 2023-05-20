<?php

namespace App\Orchid\Layouts\FindPair;

use App\Models\Crossword;
use App\Models\Find_a_Pair_Data;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class FindPairDataTable extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'data';

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
                ->render(function (Find_a_Pair_Data $data) {
                    return $data->title;
                }),

//            TD::make('description',__('Опис кросворду'))
//                ->render(function (Find_a_Pair_Data $crossword) {
//                    return $crossword->description;
//                }),
//
//            TD::make('lesson',__('Належить до уроку'))
//                ->render(function (Find_a_Pair_Data $crossword){
//                    return $crossword->lesson->title;
//                }),
        ];
    }
}
