<?php


namespace App\DTO\TestsDTO;


use App\Models\Find_a_Pair;
use App\Models\Find_a_Pair_Data;
use App\Models\PairLessonsAnswer;

class FindPairDTO
{
    /**
     * @var int
     */
    public int $lesson_id;
    /**
     * @var bool
     */
    public bool $completed = false;
    /**
     * @var object
     */
    public object $data;

    /**
     * @var object
     */
    private object $object;

    /**
     * @var object
     */
    private object $answer;

    private int $count_dat;

    public bool $empty = false;

    public function __construct(int $lesson_id){
        $this->lesson_id = $lesson_id;
        $this->setFindPair();
    }

    private function setFindPair(){
        $data = Find_a_Pair::with('data')->where(['lesson_id'=>$this->lesson_id])->get();
        if(count($data) != 0 ){
            $this->object = $data->first();
            $this->setData($this->object->data);
        }else{
            $this->empty = true;
        }
    }

    private function setData($data){
        $return = collect();
        $this->count_dat = $data->count();
        foreach ($data->shuffle() as $question){
            $dat = collect();
            $dat->put('id',$question->id);
            //$dat->put('title',$question->title);
            //$dat->put('description',$question->description);
            $dat->put('image_src',$question->image);
            $dat->put('text',$question->text);
            //$dat = $dat->shuffle();
            $return->push($dat);
        }
        $this->data = $return;
        $this->check_completed();
    }


    public function setCompleted(array $array){
        $pair_1 = Find_a_Pair_Data::find($array[0]);
        $pair_2 = Find_a_Pair_Data::find($array[1]);
        if($pair_1->id === $pair_2->pair_id or $pair_2->id === $pair_1->pair_id ){
            $answer = new PairLessonsAnswer();
            $answer->user_id = 1;
            $answer->find_a_pair_id = $this->object->id;
            $answer->answer_pair_id_first = $pair_1->id;
            $answer->answer_pair_id_second = $pair_2->id;
            $answer->reply = true;
            $answer->save();
            return true;
        }else{
            $answer = new PairLessonsAnswer();
            $answer->user_id = 1;
            $answer->find_a_pair_id = $this->object->id;
            $answer->answer_pair_id_first = $pair_1->id;
            $answer->answer_pair_id_second = $pair_2->id;
            $answer->reply = false;
            $answer->save();
            return false;
        }
    }

    private function check_completed(){
        $this->answer = PairLessonsAnswer::where(['user_id'=>1,'find_a_pair_id'=>$this->object->id,'reply'=>true])->get();
        if($this->count_dat <= $this->answer->count()){
            $this->completed = true;
        }
    }

    public function object(){
        $data = get_object_vars($this);
        unset($data['object']);
        unset($data['answer']);
        unset($data['count_dat']);
        return $data;
    }
}
