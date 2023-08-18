<?php

namespace App\Orchid\Screens\OpenQuestion;

use App\Models\OpenQuestion;
use App\Orchid\Layouts\OpenQuestion\OpenQuestionAll;
use Orchid\Screen\Screen;

class OpenQuestionList extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'open_question'=>OpenQuestion::all()
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Завдання відкрите питання';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [

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
            OpenQuestionAll::class
        ];
    }
}
