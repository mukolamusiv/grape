<?php

namespace App\Orchid\Screens\Question;

use App\Models\Answer;
use App\Models\Question;
use App\Orchid\Layouts\Question\AnswerEditLayout;
use App\Orchid\Layouts\Question\AnswerTableLayout;
use App\Orchid\Layouts\Question\QuestionEditLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class QuestionEditScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(Question $question): iterable
    {
        return [
            'question' => $question,
            'answer'=>$question->answer,
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Редагування запитання';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            ModalToggle::make('Додати відповідь')
                ->modal('createAnswer')
                ->modalTitle('Додавання нової відповіді')
                ->method('createAnswer')
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
            QuestionEditLayout::class,
            AnswerTableLayout::class,
            Layout::modal('createAnswer',AnswerEditLayout::class),
            Layout::modal('editAnswer',AnswerEditLayout::class)->async('asyncGetAnswer')
        ];
    }


    public function asyncGetAnswer(Answer $answer){
        return [
          'answer'=>$answer
        ];
    }

    /**
     * @param Question $question
     * @param Request $request
     */
    public function createAnswer(Question $question, Request $request){
        $answer = new Answer($request->get('answer'));
        $question->answer()->save($answer);
        Toast::info('Додано нову відповідь на запитання');
    }

    public function editAnswer(Answer $answer, Request $request){
        //dd($request->input('answer'));
        $data = Answer::updateOrCreate(['id'=>$answer->id],$request->input('answer'));
        Toast::info('Оновлено відповідь');
    }

    public function removeAnswer(Request $request){
        Answer::destroy($request->get('id'));
        Toast::success('Видалено відповідь');
    }
}
