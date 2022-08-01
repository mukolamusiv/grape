<?php

namespace App\Orchid\Screens\Topic;

use App\Models\Topic;
use App\Orchid\Layouts\Topic\TopicEditLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class TopicEditScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(Topic $topic): iterable
    {
        return [
            'topic'=>$topic
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Створення курсу';
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
            Layout::block(TopicEditLayout::class)
                ->title(__('Інформація про тему курсу'))
                ->description(__('Тут можна редагувати теми'))
                ->commands(
                    Button::make(__('Зберегти'))
                        ->type(Color::DEFAULT())
                        ->icon('check')
                        //->canSee($this->user->exists)
                        ->method('save')
                ),
        ];
    }


    public function save(Topic $topic, Request $request){
        $request->validate([
            'topic.title' => [
                'required'
            ],
            'topic.description'=>[
                'required'
            ]
        ]);

        $topic->fill($request->get('topic'))->save();
        Toast::success(__('Тему створено!'));
        return redirect()->route('topic.list');
    }
}
