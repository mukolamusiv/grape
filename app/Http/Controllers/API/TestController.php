<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Test\PairRequest;
use App\Http\Requests\Test\QuestionRequest;
use App\Models\Answer;
use App\Models\Question;
use App\Models\QuestionLessonsAnswer;
use App\Models\User;
use App\Models\UserLessons;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function question(QuestionRequest $questionRequest, $question_id){
        $question = Question::findOrFail($question_id);
        $answer = Answer::findOrFail($questionRequest->input('answer_id'));
        $data = QuestionLessonsAnswer::where(['answer_id'=>$questionRequest->input('answer_id'),'user_id'=>1,'question_id'=>$question_id])->get();
        if($data->isNotEmpty()){
            $data = $data->first();
            if($data->reply){
                return response('Ви вже відповідали на це запитання');
            }
        }
        if($answer->correct){
            $data = new QuestionLessonsAnswer();
            $data->question_id = $question_id;
            $data->user_id = 1;
            $data->answer_id = $questionRequest->input('answer_id');
            $data->reply = true;
            $data->save();
            $count = $question->lesson->question->count();
            $water = UserLessons::where(['lesson_id'=>$question->lesson->id,'user_id'=>1])->get()->first()->water/2;
            $water = $water/$count;
            $user = User::find(1);
            $user->water = $user->water+$water;
            $user->save();
            return response(['water'=>$water]);
        }else{
            $data = new QuestionLessonsAnswer();
            $data->question_id = $question_id;
            $data->user_id = 1;
            $data->answer_id = $questionRequest->input('answer_id');
            $data->reply = false;
            $data->save();
            return response('not true');
        }
    }

    public function pair(PairRequest $pairRequest){

    }

    public function crossword(){

    }
}
