<?php


namespace App\DTO\BuildDTO\ComponetntDTO;


use App\DTO\BuildDTO\LessonBuilderDTO;
use App\Models\Lessons;
use App\Models\UserTopic;
use Illuminate\Support\Collection;
use function Symfony\Component\Translation\t;

class ComponentTopicDTO
{

    private bool $start;
    /**
     * Те що потрібно повернути
     */
    public int      $topic_id;
    public int      $id;
    public string   $title;
    public string   $description;
    public string   $photo;
    public int      $status;
    public int      $user_id;
    public Collection $lessons;
    /**
     *
     */


    public Collection $topic;

    public Collection $lessonsDTO;


    /**
     *
     *
     * "topic_id": 1,
    "id": 1,
    "title": "Готуємося до сповіді",
    "description": "Пропонуємо методичні матеріали для підготовки дітей до першої сповіді та урочистого святого Причастя, а також матеріали для 1, 2, і 3 класів.",
    "photo": "/storage/2022/09/05/facee1a8fe654330f8a5deeba6ded2f87ed11955.png",
    "status": 75,
    "user_id": 1,
     *
     */

    /**
     * ComponentTopicDTO constructor.
     * @param Collection $topic
     * @param int $user_id
     */
    public function __construct(Collection $topic, int $user_id)
    {
        $this->user_id = $user_id;
        $this->topic = $topic;
        $this->buildTopic();
        $this->findData();
    }

    /**
     * @return mixed
     */
    public function findData(){
        $this->lessons = collect();
        $this->lessonsDTO = collect();
        foreach ($this->topic['lessons'] as $lesson){
            $data = new LessonBuilderDTO(collect($lesson),$this->user_id);
            $this->lessonsDTO->push($data);
            //$this->lessonsDTO = $data;
            $this->lessons->push($data->getLesson());
        }
        //dd($this->lessonsDTO,$this->lessons);
        $this->setStatus();
    }

    private function setStatus(){
        if($this->topic['user_topic']){
            $this->start = true;
            $true = 0;
            $lessons = $this->lessons;
            foreach ($lessons as $lesson){
                if($lesson[0]->lesson_completed){
                    $true++;
                }
            }
            $this->status = $true;
            if($true != 0){
                $this->status = $true*100/count($this->lessons);
                if($this->status === 100){
                    $this->setDone();
                }else{
                    $status = UserTopic::find($this->topic['user_topic'][0]['id']);
                    $status->complete = false;
                    $status->save();
                    //dd($status);
                }
            }else{
                $status = UserTopic::find($this->topic['user_topic'][0]['id']);
                $status->complete = false;
                $status->save();
            }
            if(count($lessons) == 0){
                $this->status = 0;
            }
        }else{
            $this->start = false;
            $this->status = 0;
        }
    }

    private function buildTopic(){
        $this->topic_id = $this->topic['id'];
        $this->id = $this->topic_id;
        $this->title = $this->topic['title'];
        $this->description = $this->topic['description'];
        $this->photo = $this->topic['photo'];
    }

    public function getTopic(){
        $topic = collect();
        $topic->put('topic_id',$this->topic_id);
        $topic->put('title',$this->title);
        $topic->put('description',$this->description);
        $topic->put('photo',$this->photo);
        $topic->put('user_id',$this->user_id);
        if(isset($this->status) and $this->status > 0){
            $topic->put('status',$this->status);
        }else if($this->start) {
            $topic->put('status',$this->status);
        }
        $topic->put('lessons',$this->lessonsDTO);
        $this->setStatus();
        return $topic;
    }


    private function setDone(){
        $status = UserTopic::find($this->topic['user_topic'][0]['id']);
        $status->complete = true;
        $status->save();
    }

}
