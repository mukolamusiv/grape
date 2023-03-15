<?php

namespace App\Orchid\Screens\FindPair;

use App\Models\Find_a_Pair;
use App\Orchid\Layouts\FindPair\AllFindPairTable;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Screen;

class FindPairList extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'find_a_pair' => Find_a_Pair::all()
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Завдання "Знайди пару"';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Додати нове завдання')
                ->icon('pencil')
                ->route('find-pair.create')
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
            AllFindPairTable::class,
        ];
    }
}
