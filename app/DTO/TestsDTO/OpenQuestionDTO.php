<?php


namespace App\DTO\TestsDTO;


use App\Models\OneWordAnswerUser;
use App\Models\OpenQuestion;
use App\Models\OpenQuestionAnswerUser;
use Illuminate\Support\Facades\Auth;

class OpenQuestionDTO
{
    public int $id;

    public string $question;

    public bool $completed = false;

    private object $data;

    private object $answer;

    public bool $empty = false;

    public function __construct(int $lesson_id){
        $this->find($lesson_id);
    }

    private function find(int $lesson_id){
        $data = OpenQuestion::where(['lesson_id'=>$lesson_id])->get();
        if(count($data) != 0){
            $this->data = $data->first();
            $this->setVars();
            $this->setStatus($this->id);
        }else{
            $this->empty = true;
        }
    }

    private function setVars(){
        $this->question = $this->data->question;
        $this->id = $this->data->id;
    }

    private function setStatus(int $OpenQuestionId){
        $data = OpenQuestionAnswerUser::where(['user_id'=>Auth::id(),'open_question_id'=>$OpenQuestionId,'reply'=>true])->get();
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
