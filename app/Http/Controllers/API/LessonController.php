<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Find_a_Pair;
use App\Models\Lessons;
use App\Models\Question;
use App\Models\User;
use App\Models\UserLessons;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function lesson($lesson_id){
        $lesson = Lessons::findOrFail($lesson_id);
        $topic = $lesson->topic;
        $lesson = collect($lesson);
        $lesson->put('topic', $topic);
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
        $lesson = UserLessons::where(['lesson_id'=>$lesson_id,'user_id'=>1])->get();
        if($lesson->isEmpty()){
            $data_lesson = Lessons::find($lesson_id);
            $lesson = new UserLessons();
            $lesson->lesson_id = $lesson_id;
            $lesson->topic_id = $data_lesson->topic_id;
            $lesson->user_id = 1;
            $lesson->check_video = true;
            $lesson->save();
            $user = User::find(1);
            $user->water = $user->water+5;
            $user->lumen = $user->lumen+6;
            $user->save();
        }else{
            $lesson = $lesson->first();
            $lesson->check_video = true;
            $lesson->save();
            $user = User::find(1);
            $user->water = $user->water+5;
            $user->lumen = $user->lumen+6;
            $user->save();
        }
        return response(['water'=>10,'lumen'=>15]);
    }

    public function list_tests($lesson_id){
        $lesson = Lessons::find($lesson_id);
        $data = collect();
        $data->put('question',$lesson->question->count());
        $data->put('find_to_pair',$lesson->find_to_pair->count());
        return response($data);
    }
}
