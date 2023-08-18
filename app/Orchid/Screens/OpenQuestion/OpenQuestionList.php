<?php

namespace App\Orchid\Screens\OpenQuestion;

use App\Models\OneWord;
use App\Models\OneWordQuestion;
use App\Models\OpenQuestion;
use App\Orchid\Layouts\OneWord\OneWordCreateWord;
use App\Orchid\Layouts\OpenQuestion\OpenQuestionAll;
use App\Orchid\Layouts\OpenQuestion\OpenQuestionCreate;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

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
            ModalToggle::make('Додати нове відкрите питання')
                ->modal('createOpenQuestion')
                ->modalTitle('Додати запитання')
                ->method('createOpenQuestion')
                ->parameters(['open_question'=>'open_question'])
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
            \Orchid\Support\Facades\Layout::modal('createOpenQuestion',OpenQuestionCreate::class),
            OpenQuestionAll::class
        ];
    }







    public function createOpenQuestion(Request $request){
        $request->validate([
            'question' => [
                'required'
            ],
            'answer'=>[
                'required'
            ],
        ]);

        //dd($oneWord);
        $open_question = new OpenQuestion();
        $open_question->question = $request->input('question');
        $open_question->answer = $request->input('answer');
        $open_question->lesson_id = $request->input('lesson_id');

        //dd($word);
        $open_question->save();
        Toast::success(__('Додано відкрите питання!'));
        return redirect()->route('open-question.edit',$open_question->id);
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

}
