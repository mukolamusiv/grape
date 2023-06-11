<?php

namespace App\Orchid\Screens\OneWord;

use App\Models\OneWord;
use App\Orchid\Layouts\OneWord\OneWordTableAll;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class OneWordList extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'one_word'=>OneWord::all()
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Завдання одне слово';
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
                ->route('one-word.create')
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
            OneWordTableAll::class
        ];
    }
}
