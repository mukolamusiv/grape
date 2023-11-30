<?php

namespace App\Orchid\Screens\OneWord;

use App\Models\Find_a_Pair;
use App\Models\Lessons;
use App\Models\OneWord;
use App\Models\OneWordQuestion;
use App\Models\Question;
use App\Orchid\Layouts\OneWord\OneWordCreateWord;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Layout;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
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
            'one_word'=>$oneWord,
            'questions'=>$oneWord->question
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
        return [
            ModalToggle::make('Додати нове слово')
                ->modal('createOneWord')
                ->modalTitle('Додати слово')
                ->method('createOneWord')
                ->parameters(['one_word'=>'one_word'])
                ->icon('plus'),
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

            \Orchid\Support\Facades\Layout::modal('createOneWord',OneWordCreateWord::class),

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
//
//                Input::make('one_word.data.text')
//                    ->type('text')
//                    ->max(255)
//                    ->required()
//                    ->title(__('Текст завдання')),
//
//                Input::make('one_word.data.word')
//                    ->type('text')
//                    ->max(255)
//                    ->required()
//                    ->title(__('Слово-відповідь')),
//
//                Upload::make('one_word.data.file')
//                    ->targetRelativeUrl()
//                    ->title('Зображення'),



                Button::make('Зберегти зміни')
                    ->method('save')
                    ->icon('save')
            ]),

            \Orchid\Support\Facades\Layout::table('questions',[
                TD::make('title', __('Назва'))
                    ->sort()
                    ->cantHide()
                    ->filter(Input::make())
                    ->render(function (OneWordQuestion $questions) {
                        return $questions->title;
                    }),
                TD::make('description', __('Опис'))
                    ->sort()
                    ->cantHide()
                    ->filter(Input::make())
                    ->render(function (OneWordQuestion $questions) {
                        return $questions->description;
                    }),
                TD::make('text', __('Текст'))
                    ->sort()
                    ->cantHide()
                    ->filter(Input::make())
                    ->render(function (OneWordQuestion $questions) {
                        return $questions->text;
                    }),
//                TD::make('image', __('Фото'))
//                    ->sort()
//                    ->cantHide()
//                    ->filter(Input::make())
//                    ->render(function (OneWord $data) {
//                        return $data->image;
//                    }),
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



public function createOneWord(OneWord $oneWord, Request $request){
    $request->validate([
        'word.title' => [
            'required'
        ],
        'word.description'=>[
            'required'
        ],
        'word.text'=>[
            'required'
        ],
        'word.word'=>[
            'required'
        ]
    ]);

        //dd($oneWord);
        $word = new OneWordQuestion();
    $word->one_word_id = $oneWord->id;
        $word->title = $request->input('word.title');
        $word->description = $request->input('word.description');
        $word->text = $request->input('word.text');
        $word->word = $request->input('word.word');

        //dd($word);
        $word->save();
    Toast::success(__('Додано нове слово!'));
    return redirect()->route('one-word.edit',$oneWord->id);
}

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

//        $oneWordData = new OneWordQuestion();
//        $oneWordData->title = $request->input('one_word.title');
//        $oneWordData->one_word_id = $oneWord->id;
//        $oneWordData->description = $request->input('one_word.description');
//        $oneWordData->word = $request->input('one_word.data.word');
//        $oneWordData->save();

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

    public function removeOneWord(Request $request){
        OneWord::destroy($request->get('id'));
        Toast::success('Видалено одне слово');
        return redirect(route('find-pair.list'));
    }
}
