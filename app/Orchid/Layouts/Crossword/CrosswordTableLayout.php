<?php

namespace App\Orchid\Layouts\Crossword;

use App\Models\Crossword;
use App\Models\Lessons;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class CrosswordTableLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'crosswords';

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
                ->render(function (Crossword $crossword) {
                    return $crossword->title;
                }),

            TD::make('description',__('Опис кросворду'))
                ->render(function (Crossword $crossword) {
                    return $crossword->description;
                }),

            TD::make('lesson',__('Належить до уроку'))
                ->render(function (Crossword $crossword){
                    return $crossword->lesson->title;
                }),
            TD::make('topic',__('Належить до теми'))
                ->render(function (Crossword $crossword){
                    return $crossword->lesson->topic->title;
                }),

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (Crossword $crossword) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([
                            Link::make(__('Переглянути'))
                                ->route('crossword.edit', $crossword->id)
                                ->icon('pen'),

                            Link::make(__('Редагувати'))
                                ->route('crossword.edit', $crossword->id)
                                ->icon('pencil'),

                            Button::make(__('Видалити'))
                                ->icon('trash')
                                ->confirm(__('Чи впевнені '))
                                ->method('removeCrossword', [
                                    'id' => $crossword->id,
                                ]),
                        ]);
                }),
        ];
    }
}
