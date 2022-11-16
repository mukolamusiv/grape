<?php


namespace App\DTO\BuildDTO\ComponentLessonDTO;


use App\Models\Lessons;
use Illuminate\Support\Collection;

class ComponentOneWordDTO implements \App\DTO\BuildDTO\ComponentInterfaceDTO
{


    public bool $completed = false;
    public int $lesson_id;
    public Collection $questions;
    public bool $empty = false;
    public int $user_id;

    private $lessonDTO;
    private $questionDTO;
    private Collection $userAnswerDTO;


    /**
     *
     *
     * {
    "completed": false,
    "lesson_id": 13,
    "questions": [
    {
    "id": 1,
    "description": "Тест",
    "image_src": null
    }
    ],
    "empty": false,
    "user_id": 1
    }
     *
     */


    /**
     * @inheritDoc
     */
    public function object(): array
    {
        $data = array();
        $data ['completed'] = $this->completed;
        $data ['lesson_id'] = $this->lesson_id;
        $data ['questions'] = $this->questions;
        $data ['empty'] = $this->empty;
        $data ['user_id'] = $this->user_id;
        //$data['answer_user'] = $this->userAnswerDTO;
        return $data;
    }

    /**
     * @inheritDoc
     */
    public function find()
    {
        if(!empty($this->lessonDTO['one_word'])){
            $this->lesson_id = $this->lessonDTO['id'];
            $this->userAnswerDTO = collect($this->lessonDTO['one_word'][0]['answer_user']);
            //$this->setObject();
            $this->setQuestions($this->lessonDTO['one_word'][0]['question']);
            $this->setCompleted();
        }else{
            $this->empty = true;
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function __construct(Collection $lesson, int $user_id)
    {
        $this->lessonDTO = $lesson;
        $this->user_id = $user_id;
        $this->find();
    }

    /**
     * @inheritDoc
     */
    public function setAnswer($request): bool
    {
        // TODO: Implement setAnswer() method.
    }

    /**
     * @inheritDoc
     */
    public function getCompleted(): bool
    {
        return $this->completed;// TODO: Implement getCompleted() method.
    }

    private function setCompleted(){
        $data = $this->userAnswerDTO->where('user_id','=',$this->user_id)->where('reply','=',true);
        if(count($data) === count($this->questions)){
            $this->completed = true;
        }else{
            $this->completed = false;
        }
    }

    private function setQuestions($questions){
        $data = collect();
        foreach ($questions as $question){
            $datum = collect();
            $datum->put('id',$question['id']);
            $datum->put('description',$question['description']);
            $datum->put('image_src',$question['image_src']);
            $data->push($datum);
        }
        $this->questions = $data;
        //return $data;
    }

    private function setObject(){

    }
}
