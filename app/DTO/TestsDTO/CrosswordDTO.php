<?php


namespace App\DTO\TestsDTO;


use App\Models\Answer;
use App\Models\Crossword;
use App\Models\Lessons;
use App\Models\Question;
use App\Models\QuestionLessonsAnswer;
use Illuminate\Support\Facades\Auth;

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

    public int $main_word_shift = 3;
    /**
     * @var bool
     */
    public bool $completed = false;
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


    public bool $empty = false;

    private int $user_id;

    /**
     * CrosswordDTO constructor.
     * @param int $lesson_id
     * @param int $user_id
     */
    public function __construct(int $lesson_id,int $user_id){
        $this->user_id = $user_id;
        $this->lesson_id = $lesson_id;
        $this->find();
    }

    private function find(){
        $data = Crossword::with('word')->where(['lesson_id'=>$this->lesson_id])->get()->first();
        if(is_null($data)){
            //dd($data,$this->lesson_id, Crossword::all());
            $this->empty = true;
        }else{
            $this->data = $data;
            $this->setValue();
            $this->find_user_answer();
        }
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
        $data = QuestionLessonsAnswer::where(['question_id'=>$this->id,'user_id'=>$this->user_id,'reply'=>true])->get();
        if($data->isNotEmpty()){
            $this->completed = true;
        }else{
            $this->completed = false;
            dd($data);
        }
    }

    public function audit_answer($answer_id){
       $data = Answer::find($answer_id);
       return $data->correct;
    }

    private function setQuestion($word){
        $data = collect();
        foreach ($word as $value){
            if ($value->bias === null){
                $bias = 0;
            }else{
                $bias = $value->bias;
            }
            $datum = collect();
            $datum->put('id',$value->id);
            $datum->put('question_text',$value->question);
            $datum->put('shift',$bias);
            $datum->put('characters',$value->cells);
            $datum->put('answer','');
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
