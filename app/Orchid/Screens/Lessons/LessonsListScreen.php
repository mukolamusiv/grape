<?php

namespace App\Orchid\Screens\Lessons;

use App\Models\Lessons;
use App\Orchid\Layouts\Lessons\LessonsListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class LessonsListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'lessons' => Lessons::
                filters()
                //->filtersApplySelection(UserFiltersLayout::class)
                ->defaultSort('id', 'desc')
                ->paginate(),
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Список доступних уроків';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Додати новий урок')
                ->icon('pencil')
                ->route('lessons.add')
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
            LessonsListLayout::class
        ];
    }
}
