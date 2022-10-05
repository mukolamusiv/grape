<?php


namespace App\DTO\TestsDTO;


use App\Models\OneWordAnswerUser;
use App\Models\OpenQuestion;
use App\Models\OpenQuestionAnswerUser;

class OpenQuestionDTO
{
    public int $id;

    public string $question;

    public bool $completed = false;

    private object $data;

    private object $answer;

    public function __construct(int $lesson_id){
        $this->find($lesson_id);
        $this->setVars();
        $this->setStatus($this->id);
    }

    private function find(int $lesson_id){
        $data = OpenQuestion::where(['lesson_id'=>$lesson_id])->get();
        $this->data = $data->first();
    }

    private function setVars(){
        $this->question = $this->data->question;
        $this->id = $this->data->id;
    }

    private function setStatus(int $OpenQuestionId){
        $data = OpenQuestionAnswerUser::where(['user_id'=>1,'open_question_id'=>$OpenQuestionId,'reply'=>true])->get();
        if($data->count() > 0){
            $this->completed = true;
        }
    }

    public function setAnswer(string $answer){

    }

    public function object(){
        $data = get_object_vars($this);
        unset($data['data']);
        return $data;
    }
}
