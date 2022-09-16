<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Find_a_Pair;
use App\Models\Lessons;
use App\Models\Question;
use App\Models\UserLessons;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function lesson($lesson_id){
        $lesson = Lessons::findOrFail($lesson_id);
        $lesson = collect($lesson);
        $lessonUser = UserLessons::with('lessons')->where(['lesson_id'=>$lesson_id,'user_id'=>1])->get();
        if($lessonUser->isNotEmpty()){
            $lessonUser = $lessonUser->first();
            if($lessonUser->complete){
                $lesson->put('status','done');
            }else{
                $lesson->put('status','active');
            }
        }else{
            $lesson->put('status','view');
        }
        return response($lesson);
    }

    public function video($lesson_id){
        $lesson = Lessons::find($lesson_id);
        return response($lesson->attachment->first());
    }

    public function question($lesson_id){
        $question = Question::with('answer')->where(['lesson_id'=>$lesson_id])->get();
        return response($question);
    }

    /**
     * @param $lesson_id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function pair($lesson_id){
        $pair = Find_a_Pair::with('data')->where(['lesson_id'=>$lesson_id])->get();
        return response($pair);
    }

    public function crossword($lesson_id){

    }

    public function check_video($lesson_id){

    }

    public function list_tests($lesson_id){
        $lesson = Lessons::find($lesson_id);
        $data = collect();
        $data->put('question',$lesson->question->count());
        return response($data);
    }
}
