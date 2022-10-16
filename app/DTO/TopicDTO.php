<?php


namespace App\DTO;


use App\Models\Topic;
use App\Models\User;

class TopicDTO
{

public int $topic_id;
public int $id;
public string $title;
public string $description;
public $photo;
public int $water;
public int $lumen;
public int $status = 0;
public object $lessons_DTO;

private object $topic;


    public function __construct(int $topic_id)
    {
        $this->topic = Topic::find($topic_id);
        $this->id = $topic_id;
        $this->setLessons();
        $this->setVars();
    }

    public function setVars(){
        $this->topic_id = $this->id;
        $this->title = $this->topic->title;
        $this->description = $this->topic->description;
        $this->photo = $this->topic->photo;
        //$this->water = $this->topic->water;
        //$this->lumen = $this->topic->lumen;
    }

    private function setLessons(){
        $data = collect();
        foreach ($this->topic->lessons as $lesson){
            $les = new LessonDTO($lesson->id);
            $data->push($les->getLesson());
        }
        $this->lessons_DTO = $data;
    }

    public function getTopic(){
        $data = get_object_vars($this);
        return $data;
    }
}
