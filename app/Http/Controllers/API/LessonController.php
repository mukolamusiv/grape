<?php

namespace App\Http\Controllers\API;

use App\DTO\BuildDTO\LessonBuilderDTO;
use App\DTO\LessonDTO;
use App\DTO\TestsDTO\CrosswordDTO;
use App\DTO\TestsDTO\FindPairDTO;
use App\DTO\TestsDTO\OpenQuestionDTO;
use App\DTO\TestsDTO\QuestionsDTO;
use App\Http\Controllers\Controller;
use App\Models\Coloring_Page;
use App\Models\ColoringPage;
use App\Models\Crossword;
use App\Models\Find_a_Pair;
use App\Models\Lessons;
use App\Models\Question;
use App\Models\QuestionLessonsAnswer;
use App\Models\User;
use App\Models\UserLessons;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{
    public function lesson($lesson_id){

        $lesson = Lessons::find($lesson_id);
        //'UserLesson','question', 'find_to_pair','crossword','topic'
        $lesson->UserLesson;
        $lesson->question;
        $lesson->find_to_pair;
        //$lesson->crossword;
        $lesson->topic;
        $data = new LessonBuilderDTO(collect($lesson),Auth::id());
        //$data = new ComponentFinPairDTO(collect($lesson),1);
        //return $data->getLesson();

        $lesson = new LessonDTO($lesson_id,Auth::id());
        return response($lesson->getLesson());
    }

    public function video($lesson_id){
        $lesson = Lessons::find($lesson_id);
        return response($lesson->attachment->first());
    }

    public function question($lesson_id){
        $data = new QuestionsDTO($lesson_id,Auth::id());
        return response($data->test());
    }

    /**
     * @param $lesson_id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function pair($lesson_id){
        $pair = Find_a_Pair::with('data')->where(['lesson_id'=>$lesson_id])->get();
        return response($pair);
    }

    /**
     * @param $lesson_id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function find_pair($lesson_id){
        $data = new FindPairDTO($lesson_id,Auth::id());
        return response($data->object());
    }

    public function crossword($lesson_id){
        $data = new CrosswordDTO($lesson_id,Auth::id());
        return response($data->object());
    }

    public function check_video($lesson_id){
        $lesson = UserLessons::where(['lesson_id'=>$lesson_id,'user_id'=>Auth::id()])->get();
        if($lesson->isEmpty()){
            $data_lesson = Lessons::find($lesson_id);
            $lesson = new UserLessons();
            $lesson->lesson_id = $lesson_id;
            $lesson->topic_id = $data_lesson->topic_id;
            $lesson->user_id = Auth::id();
            $lesson->check_video = true;
            $lesson->water = 50;
            $lesson->lumen = 70;
            $lesson->save();
            $user = User::find(Auth::id());
            $user->water = $user->water+5;
            $user->lumen = $user->lumen+6;
            $user->save();
        }else{
            $lesson = $lesson->first();
            $lesson->check_video = true;
            $lesson->save();
            $user = User::find(Auth::id());
            $user->water = $user->water+5;
            $user->lumen = $user->lumen+6;
            $user->save();
        }
        return response(['water'=>10,'lumen'=>15]);
    }

    public function status_video($lesson_id){
        $lesson = UserLessons::where(['lesson_id'=>$lesson_id,'user_id'=>Auth::id()])->get();
        if($lesson->isEmpty()){
            return response('Ще не переглядали');
        }
        $lesson = $lesson->first();
        if($lesson->check_video){
            return response($lesson->check_video);
        }else{
            return response('Ще не переглядали');
        }
    }

    public function list_tests($lesson_id){
        $lesson = Lessons::find($lesson_id);
        $data = collect();
        $data->put('question',$lesson->question->count());
        $data->put('find_to_pair',$lesson->find_to_pair->count());
        return response($data);
    }

    public function test(){
        $data = new OpenQuestionDTO(13);
        return response($data->object());
    }

    public function open_question($lesson_id){
        $data = new OpenQuestionDTO($lesson_id,Auth::id());
        return response($data->object());
    }


    private function question_check($question){
        //$lesson_id = $question;
        foreach ($question as $qu){
            $answer = collect(QuestionLessonsAnswer::where(['question_id'=>$qu->id,'user_id'=>Auth::id(),'reply'=>true])->get());
            if($answer->count() < $question->count()){
                return false;
            }
        }
        //$count_tests = $question->answer->count();
        return true;
    }

    public function coloring_page($lesson_id){
        return response(ColoringPage::find(1));
    }

}
