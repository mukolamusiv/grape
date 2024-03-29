<?php


namespace App\DTO\TestsDTO;


use App\Models\Lessons;
use App\Models\Question;

class QuestionsDTO
{
    /**
     * @var int
     */
    public int $lesson_id;
    /**
     * @var object
     */
    public object $questions;
    /**
     * @var bool
     */
    public bool $completed = false;
    /**
     * @var int
     */
    public int $count_question;
    /**
     * @var int
     */
    public int $count_completed_question = 0;

    /**
     * @var \Illuminate\Support\Collection|object
     */
    public object $questionsDTO;

    public bool $empty = false;


    private int $user_id;

    /**
     * QuestionsDTO constructor.
     * @param int $lesson_id
     * @param int $user_id
     */
    public function __construct(int $lesson_id, int $user_id){
        $this->user_id = $user_id;
        $this->questionsDTO = collect();
        $this->lesson_id = $lesson_id;
        $this->questions = Question::with('answer')->where(['lesson_id'=>$lesson_id])->get();
        $this->count_question = $this->questions->count();
        $this->getQuestions();
        $this->setCountCompletedQuestion();
        $this->completed();
        $this->setEmpty();
    }

    private function completed(){
        if($this->count_question === $this->count_completed_question){
            $this->completed = true;
        }
    }

    private function setEmpty(){
        if($this->count_question < 1){
            $this->empty = true;
            $this->completed = false;
        }
    }

    public function test(){
        $data = get_object_vars($this);
        unset($data['questions']);
        return $data;
    }

    /**
     *
     */
    private function getQuestions(){
        //$collect = collect()
        foreach ($this->questions as $question){
            $this->questionsDTO->push($this->getQuestion($question));
        }
    }

    /**
     * @param $question
     * @return mixed
     */
    private function getQuestion($question){
        $data = new QuestionDTO($question,$this->user_id);
        return $data->object();
    }

    private function setCountCompletedQuestion(){
        $count = 0;
        foreach ($this->questionsDTO as $question){
            if($question['completed']){
                $count++;
            }
        }
        $this->count_completed_question = $count;
    }
}
