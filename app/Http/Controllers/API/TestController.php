<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Test\PairRequest;
use App\Http\Requests\Test\QuestionRequest;
use App\Models\Answer;
use App\Models\Question;
use App\Models\QuestionLessonsAnswer;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function question(QuestionRequest $questionRequest, $question_id){
        $question = Question::findOrFail($question_id);
        $answer = Answer::findOrFail($questionRequest->input('answer_id'));
        if($answer->correct){
            $data = new QuestionLessonsAnswer();
            $data->question_id = $question_id;
            $data->user_id = 1;
            $data->answer_id = $questionRequest->input('answer_id');
            $data->reply = true;
            $data->save();
            return response('true');
        }else{
            $data = new QuestionLessonsAnswer();
            $data->question_id = $question_id;
            $data->user_id = 1;
            $data->answer_id = $questionRequest->input('answer_id');
            $data->reply = true;
            $data->save();
            return response('not true');
        }
        return response($answer);
    }

    public function pair(PairRequest $pairRequest){

    }

    public function crossword(){

    }
}
