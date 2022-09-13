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
//        $lesson = Lessons::with('topic','attachment')->find($id);
        $data = Lessons::with('topic','attachment','question')->find($id);
//        $question = $data->question;
//        $data_question =
//        foreach (){
//
//        }

        $return = collect();
        $return->put('lesson_id',$data->id);
        $return->put('title',$data->title);
        $return->put('description',$data->description);
        $return->put('text',$data->text);
        $return->put('created_at',$data->created_at);
        $return->put('updated_at',$data->updated_at);
        $return->put('topic_id',$data->topic_id);
        $return->put('topic',$data->topic);
        $return->put('attachment',$data->attachment);

        $test = collect();
        $test->put('question',$data->question);
//        $test->put('attachment',$data->question);


        $return->put('tests',$test);
        return response($return);
    }

    public function next_lesson($id,$serial){

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
           $data->push($this->data_topic_available($topic));
        }
        return response($data);
    }


    private function data_water($topic){
        if(isset($topic->water)){
            return $topic->water;
        }else{
            $user_done = count(User::find(1)->topic_done);
            if(empty($user_done)){
                return 200;
            }else{
                return 60*(count($topic->lessons)/$user_done);
            }
        }
    }

    private function data_lumen($topic){
        if(isset($topic->water)){
            return $topic->water;
        }else{
            $user_done = count(User::find(1)->topic_done);
            if(empty($user_done)){
                return 200;
            }else{
                return 40*(count($topic->lessons)/$user_done);
            }
        }
    }
    /**
     * @param $topic
     * @return \Illuminate\Support\Collection
     */
    private function data_topic($topic){
        //формуємо обєкт теми
        $data = collect();
        $data->put('topic_id',$topic->topic_id);
        $data->put('title',$topic->topic->title);
        $data->put('description',$topic->topic->description);
        $data->put('photo',$topic->topic->photo);
        $data->put('water',$topic->water);
        $data->put('lumen',$topic->lumen);
        $data->put('status', round($this->status_topic($topic)));
        //$data->put('complete',$topic->topic->complete);
        $data->put('lessons',$this->data_lessons($topic->topic->lessons));
       return $data;
    }


    private function data_topic_available($topic){
        //формуємо обєкт доступної теми
        $data = collect();
        $data->put('topic_id',$topic->id);
        $data->put('title',$topic->title);
        $data->put('description',$topic->description);
        $data->put('photo',$topic->photo);
        $data->put('water',$this->data_water($topic));
        $data->put('lumen',$this->data_lumen($topic));
        $data->put('status',0);
        //$data->put('complete',$topic->topic->complete);
        $data->put('lessons',$this->data_lessons($topic->lessons));
        return $data;
    }

    /**
     * @param $lessons
     * @return \Illuminate\Support\Collection
     */
    private function data_lessons($lessons){
        //формуємо обєкт уроків
        $data = collect();
        foreach ($lessons as $lesson){
            $data->push($this->data_lesson($lesson));
        }
        return $data;
    }

    /**
     * @param $lesson
     * @return \Illuminate\Support\Collection
     */
    private function data_lesson($lesson){
        //формуємо обєкт уроку
        $data = collect();
        $data->put('lesson_id',$lesson->id);
        $data->put('title',$lesson->title);
        $data->put('description',$lesson->description);
        $data->put('text',$lesson->text);
        $data->put('points',$lesson->points);
        $data->put('level',$lesson->level);
        $data->put('record_audio',$lesson->record_audio);
        return $data;
    }


    /**
     * @param $topic
     * @return float|int
     */
    private function status_topic($topic){
        //Дані про всі уроки та пройдені
        $count_lessons = $topic->topic->lessons->count();
        $count_complete = $topic->topic->complete->count();

        //перевірка часу активності теми
        $to = Carbon::createFromFormat('Y-m-d H:s:i', date('Y-m-d H:s:i'));
        $from = Carbon::createFromFormat('Y-m-d H:s:i', $topic->updated_at);
        $diff = $to->diffInDays($from);

        //видалення якщо не пройдено жодного уроку за добу
        if($count_complete === 0 and $diff > 1){
            foreach ($topic->lessons as $lesson){
                UserLessons::destroy($lesson->id);
            }
            UserTopic::destroy($topic->id);
        }

        //розрахунок відсотків пройденості теми
        if($count_complete < 1){
            return 0;
        }else{
            return $count_complete*100/$count_lessons;
        }
    }






















    public function topics_active(){
        $topics = User::find(1)->topic_active;
        $data = collect();
        foreach ($topics as $topic){
            $data->push( $this->data_topic($topic));
        }
        return response($data);
    }

    public function topics_done(){
        $topic = User::find(1);
        //$data = collect($topic->topic_done);

        $return = collect();
        foreach ($topic->topic_done as $topic){
//            $data = collect();
//            $data->put('topic_id',$topic->topic_id);
//            $data->put('status', 100);
//            $data->put('water',$topic->water);
//            $data->put('lumen',$topic->lumen);
//            $data->put('title',$topic->topic->title);
//            $data->put('description',$topic->topic->description);
//            $data->put('photo',$topic->topic->photo);
//            $data->put('complete',$topic->topic->complete);
//            $data->put('lessons',$topic->topic->lessons);
            $return->push($this->data_topic($topic));
        }
        return response($return);
    }

    public function topic($id){
        $request = collect(UserTopic::with('topic')->where(['topic_id'=>$id,'user_id'=>1])->get());
        if($request->isNotEmpty()){
            //$data = collect(UserTopic::with('topic')->find($request->first()->id));
            //$data->forget('id');
            //$data = collect();
           // $data->push($request->first()->topic);
            //$data->put('status',50);
//            $data->put('complete',$request->first()->);
            //$data->put('topic_id',$data->id);
            return response($this->data_topic(UserTopic::with('topic')->find($request->first()->id)));
        }else{
            $data = $this->data_topic_available(Topic::with('lessons')->findOrFail($id));
            $data->forget('status');
            return response($data);
        }
    }



    /*
     *
     * */

    public function user_lessons(){

    }

    public function user_topic(){

    }

//    public function check_topic($id){
//        $topic = UserTopic::where(['user_id'=>1,'topic_id'=>$id])->get()->first();
//        if($topic->complete){
//            return response($topic->complete);
//        }else{
//            return response($topic->complete);
//        }
//    }

    public function check_lesson($id){

    }

    public function start_topic($topic_id){
        if(UserTopic::where(['user_id'=>1,'topic_id'=>$topic_id])->get()->isEmpty()){
            if(Topic::findOrFail($topic_id)){
                $UserTopic = new UserTopic();
                $UserTopic->user_id = 1;
                $UserTopic->topic_id = $topic_id;
                $UserTopic->water = 70;
                $UserTopic->lumen = 70;
                $UserTopic->save();
            }
            return response($this->data_topic_available($UserTopic->topic));
        }else{
            return response('Тема уже активна');
        }
    }

    public function stop_topic($topic_id){
        $topic = UserTopic::where(['user_id'=>1,'topic_id'=>$topic_id])->get();
        if($topic->isNotEmpty()){
            return response(UserTopic::destroy($topic->first()->id));
        }else{
            return response('Ця тема не активна');
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

    public function lesson_complete($lesson_id){

    }

    public function stop_lesson($user_lesson_id){
        $UserLesson = UserLessons::with('lessons')->find($user_lesson_id);
        if($UserLesson->isNotEmpty()){
            return response($UserLesson->destroy());
        }else{
            return response('Цей урок не активний');
        }
    }



    public function audit_answer(Request $request, $question_id){
        return response(true);
    }
}
