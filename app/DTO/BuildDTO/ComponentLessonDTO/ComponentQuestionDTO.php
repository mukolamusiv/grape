<?php


namespace App\DTO\BuildDTO\ComponentLessonDTO;


use App\Models\Lessons;
use Illuminate\Support\Collection;

class ComponentQuestionDTO
{

    public int $id;
    public string $title;
    public string $description;
    public array $answer;
    public int $lesson_id;

    private $questions;
    private int $user_id;
    private Collection $user_answer;

    /**
     *
     *
    "id": 1,
    "title": "Святі тайни",
    "description": "Скільки є Святих Тайн",
    "answer": []
     *
     */



    /**
     * @return array
     */
    public function object(): array
    {
        $array = [];
        $array['id'] = $this->id;
        $array['title'] = $this->title;
        $array['description'] = $this->description;
        $array['answer'] = $this->answer;
        return $array;
    }

    /**
     *
     */
    public function find()
    {
        if($this->questions->isNotEmpty()){
            $this->user_answer = collect($this->questions['user_answer']);
            $this->setData($this->questions);
        }else{

        }
    }

    private function setData($question){
        $this->id = $question['id'];
        $this->title = $question['title'];
        $this->description = $question['description'];
        $this->answer = $this->setDataAnswer($this->questions['answer']);
    }

    public function setDataAnswer($answers){
        $data = array();
        foreach ($answers as $answer){
            $data [] = [
                'id'=>$answer['id'],
                'text'=>$answer['text'],
                'question_id'=>$answer['question_id']
            ];
        }
        return $data;
    }

    /**
     * ComponentQuestionDTO constructor.
     * @param Collection $question
     * @param int $user_id
     */
    public function __construct(Collection $question, int $user_id)
    {
        $this->user_id = $user_id;
        $this->questions = $question;
        $this->find();
    }

    /**
     * @param $request
     * @return bool
     */
    public function setAnswer($request): bool
    {
        // TODO: Implement setAnswer() method.
    }

    /**
     * @return bool
     */
    public function getCompleted(): bool
    {
        $data = $this->user_answer;
        $data = $data->where('user_id','=',$this->user_id)->where('reply','=',true);
        if($data->isNotEmpty()){
            return true;
        }else{
            return false;
        }
    }
}
