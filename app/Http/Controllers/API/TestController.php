<?php

namespace App\Http\Controllers\API;

use App\DTO\LessonDTO;
use App\DTO\TestsDTO\CrosswordDTO;
use App\DTO\TestsDTO\OneWordDTO;
use App\DTO\TestsDTO\QuestionDTO;
use App\DTO\TestsDTO\QuestionsDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Test\CrosswordRequest;
use App\Http\Requests\Test\PairRequest;
use App\Http\Requests\Test\QuestionRequest;
use App\Models\Answer;
use App\Models\Crossword;
use App\Models\Question;
use App\Models\QuestionLessonsAnswer;
use App\Models\User;
use App\Models\UserLessons;
use App\Models\Word;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function question(QuestionRequest $questionRequest, $question_id){
        $DTO = Question::find($question_id);
        $DTO->answer;
        $DTO =  new QuestionDTO($DTO);
        if($DTO->audit_answer($questionRequest->input('answer_id'))){
            $this->add_question_answer($questionRequest->input('answer_id'),$question_id,true);
            return response(['water'=>5,'reply'=>true]);
        }else{
            $this->add_question_answer($questionRequest->input('answer_id'),$question_id);
            return response(['water'=>0,'reply'=>false]);
        }
//        return response($DTO->object());
//        $question = Question::findOrFail($question_id);
//        $answer = Answer::findOrFail($questionRequest->input('answer_id'));
//        $data = QuestionLessonsAnswer::where(['answer_id'=>$questionRequest->input('answer_id'),'user_id'=>1,'question_id'=>$question_id])->get();
//        if($data->isNotEmpty()){
//            $data = $data->last();
//            if($data->reply){
//                return response('Ви вже відповідали на це запитання');
//            }
//        }
//        if($answer->correct){
//            $data = new QuestionLessonsAnswer();
//            $data->question_id = $question_id;
//            $data->user_id = 1;
//            $data->answer_id = $questionRequest->input('answer_id');
//            $data->reply = true;
//            $data->save();
//            $count = $question->lesson->question->count();
//            $water = UserLessons::where(['lesson_id'=>$question->lesson->id,'user_id'=>1])->get()->first()->water/2;
//            $water = $water/$count;
//            $user = User::find(1);
//            $user->water = $user->water+$water;
//            $user->save();
//            return response(['water'=>$water]);
//        }else{
//            $data = new QuestionLessonsAnswer();
//            $data->question_id = $question_id;
//            $data->user_id = 1;
//            $data->answer_id = $questionRequest->input('answer_id');
//            $data->reply = false;
//            $data->save();
//            return response('not true');
//        }
    }



    public function question_result($lesson_id){
        $answers = QuestionLessonsAnswer::where(['user_id'=>1,'question_id'=>$lesson_id])->get();
        $i = 0;
        foreach ($answers as $answer){
            if(!$answer->reply){
                $i++;
            }
        }
        return response(['all'=>$answers->count(),'true'=>$i]);
    }

    public function pair(PairRequest $pairRequest){

    }

    public function one_word($lesson_id){
        $data = new OneWordDTO(13);
        return response($data->object());
    }

    public function crossword(CrosswordRequest $request, $lesson_id){
        $data = Word::findOrFail($request->input('id'));
        $answer = mb_strtolower($request->input('answer'), 'UTF-8');
        $word = mb_strtolower($data->word, 'UTF-8');
        if($answer == $word){
            return response(['reply'=>true]);
        }else{
            return response(['reply'=>false]);
        }
    }




    private function add_question_answer($answer_id,$question_id,$reply = false){
        $data = new QuestionLessonsAnswer();
        $data->question_id = $question_id;
        $data->user_id = 1;
        $data->answer_id = $answer_id;
        $data->reply = true;
        return $data->save();
    }
}
