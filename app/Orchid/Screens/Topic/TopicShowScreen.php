<?php

namespace App\Orchid\Screens\Topic;

use App\Models\Topic;
use App\Orchid\Layouts\Topic\TopicEditLayout;
use App\Orchid\Layouts\Topic\TopicLessonsLayout;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class TopicShowScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(Topic $topic): iterable
    {
        return [
            'topic'=> $topic,
            'lessons'=>$topic->lessons
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Перегляд курсу';
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
            Layout::block(TopicEditLayout::class)
                ->title('Інформація про курс')
                ->description('Вся доступна інформація про курс'),

            Layout::block(TopicLessonsLayout::class)
                ->title('Список усіх лекцій у цій темі')
                ->description('Тут має бути опис')
        ];
    }
}
