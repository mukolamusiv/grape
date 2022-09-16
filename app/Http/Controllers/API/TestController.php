<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Test\PairRequest;
use App\Http\Requests\Test\QuestionRequest;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function question(QuestionRequest $questionRequest, $question_id){
        $question = Question::findOrFail($question_id);
        $answer = Answer::findOrFail($questionRequest->input('answer_id'));
        if($answer->correct){
            return response('true');
        }else{
            return response('not true');
        }
        return response($answer);
    }

    public function pair(PairRequest $pairRequest){

    }

    public function crossword(){

    }
}
