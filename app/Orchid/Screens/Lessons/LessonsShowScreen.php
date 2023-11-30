<?php

namespace App\Orchid\Screens\Lessons;

use App\Models\Crossword;
use App\Models\Lessons;
use App\Orchid\Layouts\Lessons\LessonsEditLayout;
use App\Orchid\Layouts\Topic\TopicEditLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class LessonsShowScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(Lessons $lessons): iterable
    {
        return [
            'lessons'=>$lessons
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Перегляд уроку';
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
            Layout::block(LessonsEditLayout::class)
                ->title('Інформація про курс')
                ->description('Вся доступна інформація про курс'),
        ];
    }


    public function removeLessons(Request $request){
        Lessons::destroy($request->get('id'));
        Toast::success('Видалено урок');
        return redirect(route('lessons.list'));
    }
}
