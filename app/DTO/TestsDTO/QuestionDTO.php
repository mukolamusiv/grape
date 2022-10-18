<?php


namespace App\DTO\TestsDTO;


use App\Models\Answer;
use App\Models\Lessons;
use App\Models\Question;
use App\Models\QuestionLessonsAnswer;
use Illuminate\Support\Facades\Auth;

class QuestionDTO
{
    public int $id;
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
    public int $lesson_id;
    /**
     * @var object
     */
    public object $answer;
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
    public int $count_completed_question;

    private object $data;

    private object $correct;



    /**
     * QuestionDTO constructor.
     * @param int $question
     */
    public function __construct(object $question){
        $this->id = $question->id;
        $this->title = $question->title;
        $this->description = $question->description;
        //$this->data = $question;
        $this->find_user_answer();
        $this->setAnswer($question->answer);
        //$this->answer = $question->answer;
        //$this->answer = $this->data->answer;
    }

    private function find_user_answer(){
        $data = QuestionLessonsAnswer::where(['question_id'=>$this->id,'user_id'=>Auth::id(),'reply'=>true])->get();
        if($data->isNotEmpty()){
            $this->completed = true;
        }
    }

    public function audit_answer($answer_id){
       $data = Answer::find($answer_id);
       return $data->correct;
    }

    private function setAnswer($answer){
//        $data = collect($answer);
//        $this->answer = $data;

        $data = collect();
        foreach ($answer as $value){
            $datum = collect();
            $datum->put('id',$value->id);
            $datum->put('question_id',$value->question_id);
            $datum->put('text',$value->text);
            $data->push($datum);
        }
        $this->answer = $data;
    }

    public function object(){
        return get_object_vars($this);
    }


}
