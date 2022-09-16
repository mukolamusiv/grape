<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Lessons;
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

    public function tests($lesson_id){

    }

    public function check_video($lesson_id){

    }

    public function list_tests($lesson_id){

    }
}
