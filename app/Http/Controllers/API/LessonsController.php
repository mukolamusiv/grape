<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Lessons;
use App\Models\Topic;
use App\Models\UserLessons;
use App\Models\UserTopic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LessonsController extends Controller
{
    public function lesson($id){
        return response(Lessons::with('topic')->find($id));
    }

    public function topics(){
        return response(Topic::all());
    }

    public function topic($id){
        return response(Topic::with('lessons')->where(['id'=>$id])->get()->first());
    }



    /*
     *
     * */

    public function user_lessons(){

    }

    public function user_topic(){

    }

    public function check_topic($id){
        $topic = UserTopic::where(['user_id'=>1,'topic_id'=>$id])->get()->first();
        if($topic->complete){
            return response($topic->complete);
        }else{
            return response($topic->complete);
        }
    }

    public function check_lesson($id){

    }

    public function start_topic($topic_id){
        if(UserTopic::where(['user_id'=>1,'topic_id'=>$topic_id])->get()->isEmpty()){
            $UserTopic = new UserTopic();
            $UserTopic->user_id = 1;//Auth::id();
            $UserTopic->topic_id = $topic_id;
            $UserTopic->save();
            return response($UserTopic);
        }else{
            return response('Тема уже активна');
        }
    }

    public function start_lesson($lesson_id){

        if(UserLessons::where(['user_id'=>1,'lesson_id'=>$lesson_id])->get()->isEmpty()){
            $UserLesson = new UserLessons();
            $UserLesson->user_id = 1;//Auth::id();
            $UserLesson->lesson_id = $lesson_id;
            $UserLesson->save();
            return response($UserLesson);
        }else{
            return response('Цей урок вже активний');
        }
    }
}
