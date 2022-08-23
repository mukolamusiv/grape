<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Lessons;
use App\Models\Topic;
use App\Models\User;
use App\Models\UserLessons;
use App\Models\UserTopic;
use Carbon\Carbon;
use Faker\Core\DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LessonsController extends Controller
{
    public function lesson($id){
        return response(Lessons::with('topic')->find($id));
    }

    public function topics(){
        $user = User::find(1);
        $topics = $user->topic;
        $array = [];
        foreach ($topics as $topic){
            $array[] = $topic->topic_id;
        }
        $topics = Topic::with('lessons')->whereNotIn('id',$array)->get();

        $user_done = count(User::find(1)->topic_done);
        $data = collect();
        foreach ($topics as $topic){
            if(empty($user_done)){
                $water = 200;
                $lumen = 150;
            }else{
                $lumen = 40*(count($topic->lessons)/$user_done);
                $water = 60*(count($topic->lessons)/$user_done);
            }
            $topic = collect($topic);
            $topic->put('water',round($water));
            $topic->put('lumen',round($lumen));

            //$topic->put('prise',100);
           $data->push($topic);
        }
        //$to = Carbon::createFromFormat('Y-m-d H:s:i', date('Y-m-d H:s:i'));
        //$from = Carbon::createFromFormat('Y-m-d H:s:i', User::find(1)->updated_at);

        //$diff_in_minutes = $to->diffInMinutes($from);
        //print_r($diff_in_minutes); // Output: 20
        //return response($diff_in_minutes);
//        $db = DB::table('personal_access_tokens')->where('tokenable_id','=','1')->orderByDesc('updated_at')->limit(1)->get();
//
//        $minutes = Carbon::createFromFormat('Y-m-d H:s:i', date('Y-m-d H:s:i'))->diffInMinutes(Carbon::createFromFormat('Y-m-d H:s:i', $db->first()->updated_at));
//        $user = User::find(1);
//        $user->energy = $user->energy + ($minutes/10);
//        $user->save();
        return response($data);
    }

    public function topics_active(){
        $topics = User::find(1)->topic_active;
        $return = collect();
        foreach ($topics as $topic){
            $data = collect();
            $count_lessons = $topic->lessons->count();
            $count_complete = 0;
            foreach ($topic->lessons as $lesson){
                if($lesson->complete){
                    $count_complete++;
                }
            }
            if($count_complete < 1 and ){

            }
            $data->put('id',$topic->id);
            $data->put('topic_id',$topic->topic_id);
            $data->put('status',$count_complete*100/$count_lessons);
            $data->put('water',$topic->water);
            $data->put('lumen',$topic->lumen);
            $data->put('title',$topic->topic->title);
            $data->put('description',$topic->topic->description);
            $data->put('photo',$topic->topic->photo);
            $data->put('lessons',$topic->topic->lessons);
            $return->push($data);
        }

        return response($return);
    }

    public function topics_done(){
        $topic = User::find(1);
        return response($topic->topic_done);
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
