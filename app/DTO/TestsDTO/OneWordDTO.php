<?php


namespace App\DTO\TestsDTO;


use App\Models\OneWord;
use App\Models\OneWordAnswerUser;

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
    public object $question;

    /**
     * @var object
     */
    private object $data;

    /**
     * OneWordDTO constructor.
     * @param int $lesson_id
     */
    public function __construct(int $lesson_id)
    {
        $this->lesson_id = $lesson_id;
        $this->setData();
        $this->setQuestion($this->data->question);
        $this->completed_status();
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
        $this->question = $data;
    }

    private function setData(){
        $data = OneWord::with('question')->where(['lesson_id'=>$this->lesson_id])->get();
        $this->data = $data->first();
    }

    private function completed_status(){
        $request = OneWordAnswerUser::where(['user_id'=>1,'lesson_id'=>$this->lesson_id])->get();
        if($request->isNotEmpty()){
            foreach ($this->data->qustion as $question){
                if($request->firstWhere(['id' => $question->id]) != null){
                    $this->completed = false;
                    return false;
                }
            }
            $this->completed = true;
        }
    }

    public function object(){
        $data = get_object_vars($this);
        unset($data['data']);
        return $data;
    }

}
