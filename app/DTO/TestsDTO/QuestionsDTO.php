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

    /**
     * QuestionDTO constructor.
     * @param int $lesson_id
     */
    public function __construct(int $lesson_id){
        $this->questionsDTO = collect();
        $this->lesson_id = $lesson_id;
        $this->questions = Question::with('answer')->where(['lesson_id'=>$lesson_id])->get();
        $this->count_question = $this->questions->count();
        $this->getQuestions();
        $this->setCountCompletedQuestion();
        $this->completed();
    }

    private function completed(){
        if($this->count_question === $this->count_completed_question){
            $this->completed = true;
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
        $data = new QuestionDTO($question);
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
