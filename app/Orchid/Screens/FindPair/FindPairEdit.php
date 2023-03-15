<?php

namespace App\Orchid\Screens\FindPair;

use App\Models\Find_a_Pair;
use App\Orchid\Layouts\FindPair\FindPairEditLayouts;
use App\Orchid\Layouts\Topic\TopicEditLayout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;

class FindPairEdit extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(Find_a_Pair $find_a_Pair): iterable
    {
        return [
            'find_a_pair'=>$find_a_Pair
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Редагування/створення нового завдання знайди пару';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::block(FindPairEditLayouts::class)
                ->title(__('Інформація про завдання знайди пару'))
                ->description(__('Тут можна редагувати завдання'))
                ->commands(
                    Button::make(__('Зберегти'))
                        ->type(Color::DEFAULT())
                        ->icon('check')
                        //->canSee($this->user->exists)
                        ->method('save')
                ),
        ];
    }
}
