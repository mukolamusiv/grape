<?php


namespace App\DTO\TestsDTO;


use App\Models\Answer;
use App\Models\Crossword;
use App\Models\Lessons;
use App\Models\Question;
use App\Models\QuestionLessonsAnswer;

class CrosswordDTO
{
    public int $id;

    /**
     * @var int
     */
    public int $lesson_id;
    /**
     * @var string
     */
    public string $title;
    /**
     * @var string
     */
    public string $description;
    /**
     * @var int
     */
    public int $max_characters = 0;
    /**
     * @var bool
     */
    //public bool $completed = false;
    /**
     * @var object
     */
    public object $questions;

    //public int $count_completed_question;

    /**
     * @var object
     */
    private object $data;

    private object $words;

    private object $correct;





    /**
     * QuestionDTO constructor.
     * @param int $lesson_id
     */
    public function __construct(int $lesson_id){
        $this->lesson_id = $lesson_id;
        $this->find();
        $this->setValue();
    }

    private function find(){
        $data = Crossword::with('word')->where(['lesson_id'=>$this->lesson_id])->get()->first();
        $this->data = $data;
    }

    private function setValue(){
        $this->id = $this->data->id;
        $this->title = $this->data->title;
        $this->description = $this->data->description;
        $this->setQuestion($this->data->word);
    }

    private function max_characters($characters){
        if($characters > $this->max_characters){
            $this->max_characters = $characters;
        }
    }

    private function find_user_answer(){
        $data = QuestionLessonsAnswer::where(['question_id'=>$this->id,'user_id'=>1,'reply'=>true])->get();
        if($data->isNotEmpty()){
            $this->completed = true;
        }
    }

    public function audit_answer($answer_id){
       $data = Answer::find($answer_id);
       return $data->correct;
    }

    private function setQuestion($word){
        $data = collect();
        foreach ($word as $value){
            $datum = collect();
            $datum->put('id',$value->id);
            $datum->put('question_text',$value->question);
            $datum->put('shift',$value->bias);
            $datum->put('characters',$value->cells);
            $datum->put('answer',$value->word);
            $data->push($datum);
            $this->max_characters($value->cells+$value->bias);
        }
        $this->questions = $data;
    }

    public function object(){
        $data = get_object_vars($this);
        unset($data['data']);
        return $data;
    }


}
