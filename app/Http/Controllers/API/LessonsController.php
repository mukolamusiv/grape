<?php

namespace App\Http\Controllers\API;

use App\DTO\TopicDTO;
use App\DTO\TopicsDTO;
use App\Http\Controllers\Controller;
use App\Models\Lessons;
use App\Models\Question;
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


    public function done(){
        $data = new TopicsDTO(1);
        return response($data->getDone());
    }

    public function active(){
        $data = new TopicsDTO(1);
        return response($data->getActive());
    }

    public function all(){
        $data = new TopicsDTO(1);
        return response($data->getTopics());
    }


    public function user_done($user_id){
        $data = new TopicsDTO($user_id);
        return response($data->getDone());
    }

    public function user_active($user_id){
        $data = new TopicsDTO($user_id);
        return response($data->getActive());
    }

    public function user_all($user_id){
        $data = new TopicsDTO($user_id);
        return response($data->getTopics());
    }

    public function DTO(){
        $data = new TopicsDTO(1);
        return response($data->getTopic());
    }

    public function lesson($id){
//        $lesson = Lessons::with('topic','attachment')->find($id);
        $lesson = UserLessons::with('lessons')->where('lesson_id','=',$id)->get();
        if($lesson->isNotEmpty()){
            $lesson = $lesson->first();
            $return = collect();
            $return->put('lesson_id', $lesson->lessons->id);
            $return->put('title', $lesson->lessons->title);
            $return->put('description', $lesson->lessons->description);
            $return->put('text', $lesson->lessons->text);
            $return->put('check_video',$lesson->check_video);
            $return->put('created_at', $lesson->created_at);
            $return->put('updated_at', $lesson->updated_at);
            $return->put('topic_id', $lesson->topic_id);
            $return->put('data',$lesson);
            if($lesson->complete){
                $return->put('status', 'done');
            }else{
                $return->put('status', 'active');
            }
            //$return->put('active',$lesson->topic_active);
            //$return->put('count_lessons',$lesson->topic_active->lessons->count());
            $return->put('water',$lesson->water);
            $return->put('lumen',$lesson->lumen);
            $return->put('topic', $lesson->topic);
            $return->put('attachment', $lesson->lessons->attachment);
            $test = collect();
            $test->put('question', $lesson->lessons->question);

            $return->put('tests', $test);

            return response($return);
        }else {

            $data = Lessons::with('topic', 'attachment', 'question')->find($id);

            $return = collect();
            $return->put('lesson_id', $data->id);
            $return->put('title', $data->title);
            $return->put('description', $data->description);
            $return->put('text', $data->text);
            $return->put('data',$lesson);
            $return->put('created_at', $data->created_at);
            $return->put('updated_at', $data->updated_at);
            $return->put('topic_id', $data->topic_id);
            $return->put('topic', $data->topic);
            $return->put('attachment', $data->attachment);
            $return->put('status', 'view');
            //$return->put('check_video',$data->check_video);

            $test = collect();
            $test->put('question', $data->question);
//        $test->put('attachment',$data->question);

            $return->put('tests', $test);
            return response($return);
        }
    }


//
//    private function lesson_data($lesson){
//
//    }

    public function next_lesson($id,$serial){

    }

    public function topics($user_id = null){
        if($user_id === null){
            $user = User::find(1);
        }else{
            $user = User::find($user_id);
        }
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
        $data->put('completed',rand('0','1'));
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






















    public function topics_active($user_id = null){
        if($user_id === null){
            $user = User::find(1);
        }else{
            $user = User::find($user_id);
        }
        $topics = User::find(1)->topic_active;
        $data = collect();
        foreach ($topics as $topic){
            $data->push( $this->data_topic($topic));
        }
        return response($data);
    }

    public function topics_done($user_id = null){
        if($user_id === null){
            $user = User::find(1);
        }else{
            $user = User::find($user_id);
        }
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
        $lesson = Lessons::find($lesson_id);
        if(UserLessons::where(['user_id'=>1,'lesson_id'=>$lesson_id])->get()->isEmpty()){
            $UserTopic  = UserTopic::where(['user_id'=>1,'topic_id'=>$lesson->topic_id])->get();
            $UserTopic = $UserTopic->first();
            $UserLesson = new UserLessons();
            $UserLesson->user_id = 1;//Auth::id();
            $UserLesson->lesson_id = $lesson_id;
            $UserLesson->topic_active_id = $UserTopic->id;
            $UserLesson->water = 15;
            $UserLesson->lumen = 20;
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
        $question = Question::find($question_id);
        return response(true);
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


    public function check_video_false($lesson_id){
        $lesson = UserLessons::where(['lesson_id'=>$lesson_id,'user_id'=>1])->get();
        if($lesson->isEmpty()){
            $data_lesson = Lessons::find($lesson_id);
            $lesson = new UserLessons();
            $lesson->lesson_id = $lesson_id;
            $lesson->topic_id = $data_lesson->topic_id;
            $lesson->user_id = 1;
            $lesson->check_video = false;
            $lesson->save();
            //$user = User::find(1);
            //$user->water = $user->water+5;
            //$user->lumen = $user->lumen+6;
            //$user->save();
        }else{
            $lesson = $lesson->first();
            $lesson->check_video = false;
            $lesson->save();
            $user = User::find(1);
            $user->water = $user->water+5;
            $user->lumen = $user->lumen+6;
            $user->save();
        }
        return response(['water'=>10,'lumen'=>15]);
    }
}
