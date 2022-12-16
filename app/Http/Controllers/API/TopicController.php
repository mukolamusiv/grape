<?php

namespace App\Http\Controllers\API;

use App\DTO\BuildDTO\ComponetntDTO\ComponentTopicDTO;
use App\DTO\BuildDTO\TopicBuilderDTO;
use App\DTO\TopicDTO;
use App\DTO\TopicsDTO;
use App\Http\Controllers\Controller;
use App\Models\Topic;
use Illuminate\Support\Facades\Auth;

class TopicController extends Controller
{
    public function done(){
        $data = new TopicBuilderDTO(Auth::id());
        return response($data->buildDone(Auth::id()));
//        $data = new TopicsDTO(Auth::id());
//        return response($data->getDone());
    }

    public function active(){
        $data = new TopicBuilderDTO(Auth::id());
        return response($data->buildActive(Auth::id()));
//        $data = new TopicsDTO(Auth::id());
//        return response($data->getActive());
    }

    public function all(){
        $data = new TopicBuilderDTO(Auth::id());
        return response($data->buildTopics(Auth::id()));
//        $data = new TopicsDTO(Auth::id());
//        return response($data->getTopics());
    }

    public function user_done($user_id){
        $data = new TopicBuilderDTO($user_id);
        return response($data->buildDone($user_id));
//        $data = new TopicsDTO($user_id);
//        return response($data->getDone());
    }

    public function user_active($user_id){
        $data = new TopicBuilderDTO($user_id);
        return response($data->buildActive($user_id));
//        $data = new TopicsDTO($user_id);
//        return response($data->getActive());
    }

    /**
     * @param $user_id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function user_all($user_id){
        $data = new TopicBuilderDTO($user_id);
        return response($data->buildTopics($user_id));
//        $data = new TopicsDTO($user_id);
//        return response($data->getTopics());
    }

    public function getTopic($id){
        $data = Topic::find($id);
        $data->lessons;
        $data->UserTopic;
        $data = new ComponentTopicDTO(collect($data),Auth::id());
        return response($data->getTopic());
//        $data = new TopicDTO($id,Auth::id());
//        return response($data->getTopic());
    }

}
