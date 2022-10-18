<?php


namespace App\DTO\TestsDTO;


use App\Models\OneWord;
use App\Models\OneWordAnswerUser;
use App\Models\OneWordQuestion;
use Illuminate\Support\Facades\Auth;

class OneWordDTO
{
    /**
     * @var bool
     */
    public bool $completed = false;

    /**
     * @var int
     */
    public int $lesson_id;

    /**
     * @var object
     */
    public object $questions;

    /**
     * @var object
     */
    private object $data;

    public bool $empty = false;
    /**
     * OneWordDTO constructor.
     * @param int $lesson_id
     */
    public function __construct(int $lesson_id)
    {
        $this->lesson_id = $lesson_id;
        $this->setData();
    }

    private function setQuestion($questions){
        $data = collect();
        foreach ($questions as $question){
            $dat = collect();
            $dat->put('id',$question->id);
            $dat->put('description',$question->description);
            $dat->put('image_src',$question->image_src);
            $data->push($dat);
        }
        $this->questions = $data;
    }

    private function setData(){
        $data = OneWord::with('question')->where(['lesson_id'=>$this->lesson_id])->get();
        if(count($data) != 0){
            $this->data = $data->first();
            $this->setQuestion($this->data->question);
            $this->completed_status();
        }else{
            $this->empty = true;
        }
    }

    /**
     * @return false
     */
    private function completed_status(){
        $request = OneWordAnswerUser::where(['user_id'=>Auth::id(),'lesson_id'=>$this->lesson_id])->get();
        if($request->isNotEmpty()){
            foreach ($this->data->question as $question){
                if($request->firstWhere(['id' => $question->id]) != null){
                    $this->completed = false;
                    return false;
                }
            }
            $this->completed = true;
        }
    }

    public function answer(int $id,string $answer){
        $data = OneWordQuestion::findOrFail($id);
        $answer = mb_strtolower($answer, 'UTF-8');
        $word = mb_strtolower($data->word, 'UTF-8');
        if($answer == $word){
            $data = new OneWordAnswerUser();
            $data->user_id = 1;
            $data->lesson_id = $this->lesson_id;
            $data->one_word_id = $this->data->id;
            $data->one_word_question_id = $id;
            $data->reply = true;
            $data->save();
            return true;
        }else{
            $data = new OneWordAnswerUser();
            $data->user_id = 1;
            $data->lesson_id = $this->lesson_id;
            $data->one_word_id = $this->data->id;
            $data->one_word_question_id = $id;
            $data->reply = false;
            $data->save();
            return false;
        }
    }

    public function object(){
        $data = get_object_vars($this);
        unset($data['data']);
        return $data;
    }

}
