<?php

namespace App\Orchid\Screens\Topic;

use App\Models\Topic;
use App\Orchid\Layouts\Topic\TopicTableLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class TopicScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'topics' => Topic::
            //filters()
                //->filtersApplySelection(UserFiltersLayout::class)
                //->defaultSort('id', 'desc')
                paginate(),
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Теми курсів';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Додати нову тему курсів')
                ->icon('pencil')
                ->route('topic.create')
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            TopicTableLayout::class
        ];
    }
}
