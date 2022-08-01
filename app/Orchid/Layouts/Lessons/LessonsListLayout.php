<?php

namespace App\Orchid\Layouts\Lessons;

use App\Models\Lessons;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Screen\Fields\Input;

class LessonsListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'lessons';

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
                ->render(function (Lessons $lessons) {
                    return $lessons->title;
                }),
            TD::make('description', __('Опис'))
                ->sort()
                ->filter(Input::make())
                ->render(function (Lessons $lessons) {
                    return $lessons->description;
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
                ->render(function (Lessons $lessons) {
                    return $lessons->points;
                })->width('150px'),
            TD::make('level', __('Рівень'))
                ->sort()
                ->filter(Input::make())
                ->render(function (Lessons $lessons) {
                    return $lessons->level;
                })->width('150px'),

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (Lessons $lessons) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([
                            Link::make(__('Переглянути'))
                                ->route('lessons.show', $lessons->id)
                                ->icon('pen'),

                            Link::make(__('Редагувати'))
                                ->route('lessons.edit', $lessons->id)
                                ->icon('pencil'),

                            Button::make(__('Видалити'))
                                ->icon('trash')
                                ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                                ->method('remove', [
                                    'id' => $lessons->id,
                                ]),
                        ]);
                }),
        ];
    }
}
