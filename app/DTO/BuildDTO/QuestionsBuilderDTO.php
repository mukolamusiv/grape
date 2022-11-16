<?php


namespace App\DTO\BuildDTO;

use App\DTO\BuildDTO\ComponentLessonDTO\ComponentQuestionDTO;
use Illuminate\Support\Collection;

class QuestionsBuilderDTO
{
    public int $user_id;
    public int $lesson_id;
    public bool $completed = false;
    public int $count_question = 0;
    public int $count_completed_question = 0;
    public Collection $questionDTO;
    public bool $empty = false;

    private Collection $lesson;
    private $questions;

    /**
     *
    "lesson_id": 13,
    "completed": false,
    "count_question": 1,
    "count_completed_question": 0,
    "questionsDTO": []
     *
     */

    /**
     * QuestionsBuilderDTO constructor.
     * @param Collection $lesson
     * @param int $user_id
     */
    public function __construct(Collection $lesson, int $user_id)
    {
        $this->lesson = $lesson;
        $this->user_id = $user_id;
        $this->find();
    }

    private function find(){
        if(!empty($this->lesson['question'])){
            $this->questions = $this->lesson['question'];
            $this->buildData();
        }else{
            $this->lesson_id = $this->lesson['id'];
            $this->questionDTO = collect();
            $this->empty = true;
        }
    }

//    private function build(){
//
//    }

    private function buildData(){
        $this->lesson_id = $this->lesson['id'];
        $this->questionDTO = collect();
        foreach ($this->questions as $question){
            $this->questionDTO->push($this->buildQuestion($question,$this->user_id));
        }
    }

    public function buildQuestion($question, $user_id){
        $data = new ComponentQuestionDTO(collect($question),$user_id);
        $this->count_question = $this->count_question + 1;
        if($data->getCompleted()){
            $this->count_completed_question = $this->count_completed_question + 1;
        }
        return $data->object();
    }

    private function setCompleted(){
        if($this->count_completed_question === $this->count_question){
            $this->completed = true;
        }
        return $this->completed;
    }

    public function build(){
        $data = collect();
        $data->put('lesson_id',$this->lesson_id);
        $data->put('completed',$this->setCompleted());
        $data->put('count_question',$this->count_question);
        $data->put('count_completed_question',$this->count_completed_question);
        $data->put('empty',$this->empty);
        $data->put('questionDTO',$this->questionDTO);
        return $data;
    }
}
