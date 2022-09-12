<?php

namespace App\Orchid\Screens\Question;

use App\Models\Question;
use App\Orchid\Layouts\Question\QuestionTableLayout;
use Orchid\Screen\Layout;
use Orchid\Screen\Screen;
use function Termwind\ValueObjects\block;

class QuestionScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'questions'=>Question::all()
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Тести для уроків';
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
            \Orchid\Support\Facades\Layout::block(QuestionTableLayout::class)
                ->title('Зпитання')
            ->description('запитання до уроку'),
            \Orchid\Support\Facades\Layout::block(QuestionTableLayout::class)
                ->title('Відповіді')
                ->description('Усі відповіді до запитань'),
        ];
    }
}
