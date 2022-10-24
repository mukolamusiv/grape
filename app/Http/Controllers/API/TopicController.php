<?php

namespace App\Http\Controllers\API;

use App\DTO\TopicDTO;
use App\DTO\TopicsDTO;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TopicController extends Controller
{
    public function done(){
        $data = new TopicsDTO(Auth::id());
        return response($data->getDone());
    }

    public function active(){
        $data = new TopicsDTO(Auth::id());
        return response($data->getActive());
    }

    public function all(){
        $data = new TopicsDTO(Auth::id());
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

    public function getTopic($topic_id){
        $data = new TopicDTO($topic_id,\auth()->id());
        return response($data->getTopic());
    }

}
