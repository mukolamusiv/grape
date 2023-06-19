<?php

namespace App\Orchid\Screens\OneWord;

use App\Models\Lessons;
use App\Models\OneWord;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Layout;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class OneWordEdit extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(OneWord $oneWord): iterable
    {
        return [
            'one_word'=>$oneWord
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Редагувати/Додати завдання одне слово';
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
            \Orchid\Support\Facades\Layout::rows([
                Input::make('one_word.title')
                    ->type('text')
                    ->max(255)
                    ->required()
                    ->title(__('Назва завдання')),

                Input::make('one_word.description')
                    ->type('text')
                    ->max(255)
                    ->required()
                    ->title(__('Опис завдання'))
                    ->placeholder(__('Про що це завдання')),
                Select::make('one_word.lesson_id')
                    ->fromModel(Lessons::class,'title')
                    ->title(__('Назва уроку'))
                    ->help('Оберіть урок для кого належить кросворд'),

                Input::make('one_word.data.text')
                    ->type('text')
                    ->max(255)
                    ->required()
                    ->title(__('Текст завдання')),

                Input::make('one_word.data.word')
                    ->type('text')
                    ->max(255)
                    ->required()
                    ->title(__('Слово-відповідь')),

                Upload::make('one_word.data.file')
                    ->targetRelativeUrl()
                    ->title('Зображення'),



                Button::make('Зберегти зміни')
                    ->method('save')
                    ->icon('save')
            ]),

//            \Orchid\Support\Facades\Layout::rows([
//                Input::make('one_word.title')
//                    ->type('text')
//                    ->max(255)
//                    ->required()
//                    ->title(__('Назва завдання')),
//
//                Input::make('one_word.description')
//                    ->type('text')
//                    ->max(255)
//                    ->required()
//                    ->title(__('Опис завдання'))
//                    ->placeholder(__('Про що це завдання')),
//                Select::make('one_word.lesson_id')
//                    ->fromModel(Lessons::class,'title')
//                    ->title(__('Назва уроку'))
//                    ->help('Оберіть урок для кого належить кросворд'),
//                Button::make('Зберегти зміни')
//                    ->method('save')
//                    ->icon('save')
//            ]),

        ];
    }



//         $table->string('description');
//            $table->string('title');
//            $table->string('image_src')->nullable();
//            $table->string('text')->nullable();
//            $table->string('word');

    public function save(OneWord $oneWord, Request $request){
        $request->validate([
            'one_word.title' => [
                'required'
            ],
            'one_word.description'=>[
                'required'
            ]
        ]);

        $oneWord->fill($request->get('one_word'))->save();
//        if($request->file('topic.photo')){
//
//        }
        //$photo = $request->file('topic.photo');
        //dd($request);
        //$topic->photo = $photo->store(date('Y'.'/'.'m'.'/'.'d'),'public');
        $oneWord->save();
        //Toast::success(__('Фото додано!'));
        Toast::success(__('Додано нове завдання!'));
        return redirect()->route('one-word.list');
    }
}
