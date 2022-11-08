<?php


namespace App\DTO\BuildDTO;

use App\Models\Topic;
use Illuminate\Support\Collection;

class TopicBuilderDTO
{
    public int $user_id;

    public Collection $active;

    public Collection $done;

    public Collection $topics;

    public Collection $all;

    public Collection $data;

    public function __construct(int $user_id)
    {
        $this->user_id = $user_id;
        $this->findData();
    }

    /**
     *
     */
    private function findData(){
        $this->data = Topic::with('UserTopic','lessons')->get();
    }

    /**
     * @param int $user_id
     * @return Collection
     */
    public function buildActive(int $user_id)
    {
        $this->active = collect();
        foreach ($this->data as $topic)
        {
            if($topic->UserTopic->where('user_id','=',$user_id)->count() > 0){
                $this->active->push($topic);
            }
        }
        return $this->active;
    }

    /**
     * @param int $user_id
     * @return Collection
     */
    public function buildDone(int $user_id)
    {
        $this->done = collect();
        foreach ($this->data as $topic)
        {
            if($topic->UserTopic->where('user_id','=',$user_id)->where('complete','=',true)->count() > 0){
                $this->done->push($topic);
            }
        }
        return $this->done;
    }

    /**
     * @param int $user_id
     * @return Collection
     */
    public function buildTopics(int $user_id)
    {
        $this->topics = collect();
        foreach ($this->data as $topic)
        {
            if($topic->UserTopic->where('user_id','=',$user_id)->count() == 0){
                $this->topics->push($topic);
            }
        }
        return $this->topics;
    }
}
