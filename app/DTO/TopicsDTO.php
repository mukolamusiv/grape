<?php


namespace App\DTO;


use App\Models\Topic;
use App\Models\User;

class TopicsDTO
{
    private object $user;

    public object $active;

    public object $done;

    public object $topics;

    public function __construct(int $user_id)
    {
        $this->user = User::find($user_id);
    }

    public function getTopics(){
        $this->setTopics();
        return $this->topics;
    }

    public function getActive(){
        $this->setActive();
        return $this->active;
    }

    public function getDone(){
        $this->setDone();
        return $this->done;
    }

    private function setActive(){
        $topics = $this->user->topic_active;
        $data = collect();
        foreach ($topics as $topic){
            $top = new TopicDTO($topic->topic_id,$this->user->id);
            $data->push($top->getTopic());
        }
        $this->active = $data;
    }

    private function setDone(){
        $data = collect();
        foreach ($this->user->topic_done as $topic){
            $top = new TopicDTO($topic->topic_id,$this->user->id);
            $data->push($top->getTopic());
        }
        $this->done = $data;
    }

    private function setTopics(){
        $topics = $this->user->topic;
        $array = [];
        foreach ($topics as $topic){
            $array[] = $topic->topic_id;
        }
        $topics = Topic::whereNotIn('id',$array)->get();
        //$user_done = count(User::find(1)->topic_done);

        $data = collect();
        foreach ($topics as $topic){
            $top = new TopicDTO($topic->id,$this->user->id);
            $data->push($top->getTopic());
        }
        $this->topics = $data;
    }

    public function getTopic(){
        $data = get_object_vars($this);
        return $data;
    }
}
