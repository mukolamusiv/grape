<?php

namespace App\Orchid\Screens\OpenQuestion;

use App\Models\Lessons;
use App\Models\OneWord;
use App\Models\OneWordQuestion;
use App\Models\OpenQuestion;
use App\Models\OpenQuestionAnswerUser;
use App\Orchid\Layouts\OpenQuestion\OpenQuestionCreate;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Toast;

class OpenQuestionEdit extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(OpenQuestion $openQuestion): iterable
    {
        return [
            'open_question'=>$openQuestion,
            'answers'=>$openQuestion->answerUser
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Відкрите питання';
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
            \Orchid\Support\Facades\Layout::rows([
                Input::make('open_question.question')
                    ->type('text')
                    ->max(255)
                    ->required()
                    ->title(__('Текст запитання')),

                Input::make('open_question.answer')
                    ->type('text')
                    ->max(255)
                    ->required()
                    ->title(__('Очікувана відповідь')),

                Select::make('open_question.lesson_id')
                    ->fromModel(Lessons::class,'title')
                    ->title(__('Назва уроку'))
                    ->help('Оберіть урок для кого належить кросворд'),

                Button::make('Зберегти зміни')
                    ->method('save')
                    ->icon('save')
            ]),



            \Orchid\Support\Facades\Layout::table('answers',[
                TD::make('User', __('Користувач'))
                    ->sort()
                    ->cantHide()
                    ->filter(Input::make())
                    ->render(function (OpenQuestionAnswerUser $answers) {
                        return $answers->user->name.' '.$answers->user->surname;
                    }),
                TD::make('answer', __('Відповідь'))
                    ->sort()
                    ->cantHide()
                    ->filter(Input::make())
                    ->render(function (OpenQuestionAnswerUser $answer) {
                        return $answer->answer;
                    }),
                TD::make('text', __('Текст'))
                    ->sort()
                    ->cantHide()
                    ->filter(Input::make())
                    ->render(function (OpenQuestionAnswerUser $answer) {
                       if($answer->audit){
                           return 'Перевірено';
                       }else{
                           return 'Ще не перевірено';
                       }
                    }),
        ]),
        ];
    }


    public function save(OpenQuestion $openQuestion, Request $request){
        $request->validate([
            'open_question.question' => [
                'required'
            ],
            'open_question.answer'=>[
                'required'
            ]
        ]);

        $openQuestion->fill($request->get('open_question'))->save();
        Toast::success(__('Зміни збережено'));
        return redirect()->route('open-question.edit',$openQuestion->id);
    }
}
