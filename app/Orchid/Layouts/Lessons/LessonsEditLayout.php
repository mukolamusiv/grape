<?php

namespace App\Orchid\Layouts\Lessons;

use App\Models\Topic;
use Orchid\Attachment\File;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Layouts\Rows;

class LessonsEditLayout extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title;

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): iterable
    {
        return [
            Input::make('lessons.title')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Назва'))
                ->placeholder(__('Назва уроку')),

            Input::make('lessons.description')
                ->type('text')
                ->max(255)
                ->title(__('Опис уроку'))
                ->placeholder(__('Опис уроку')),

            Quill::make('lessons.text')
                ->type('text')
                ->required()
                ->title(__('Текст уроку'))
                ->placeholder(__('Текст уроку')),

            Upload::make('lessons.attachment')
                ->maxFiles(1)
                //->targetRelativeUrl()
                ->title('Аудіо супровід'),

            Input::make('lessons.points')
                ->type('number')
                ->title('Кількість балів')
                ->placeholder(__('Максимальна кількість балів')),

            Select::make('lessons.topic_id')
                ->fromModel(Topic::class,'title')
                ->title(__('Назва курсу'))
                ->help('Оберіть курс для кого належить лекція')
        ];
    }
}
