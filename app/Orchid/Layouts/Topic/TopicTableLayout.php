<?php

namespace App\Orchid\Layouts\Topic;

use App\Models\Topic;
use Orchid\Platform\Models\User;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class TopicTableLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'topics';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('title', __('Назва'))
                //->sort()
                ->cantHide()
                ->filter(Input::make())
                ->render(function (Topic $topic) {
                    return $topic->title;
                }),
            TD::make('description', __('Опис'))
                //->sort()
                ->cantHide()
                ->filter(Input::make())
                ->render(function (Topic $topic) {
                    return $topic->description;
                }),
            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (Topic $topic) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([
                            Link::make(__('Переглянути'))
                                ->route('topic.show', $topic->id)
                                ->icon('pen'),

                            Link::make(__('Редагувати'))
                                ->route('topic.edit', $topic->id)
                                ->icon('pencil'),

                            Button::make(__('Видалити'))
                                ->icon('trash')
                                ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                                ->method('remove', [
                                    'id' => $topic->id,
                                ]),
                        ]);
                }),
        ];
    }
}
