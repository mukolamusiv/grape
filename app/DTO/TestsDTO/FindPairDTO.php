<?php


namespace App\DTO\TestsDTO;


use App\Models\Find_a_Pair;

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

    private object $object;

    public function __construct(int $lesson_id){
        $this->lesson_id = $lesson_id;
        $this->setFindPair();
    }

    private function setFindPair(){
        $data = Find_a_Pair::with('data')->where(['lesson_id'=>$this->lesson_id])->get();
        $this->object = $data->first();
        $this->setData($this->object->data);
    }

    private function setData($data){
        $return = collect();
        foreach ($data as $question){
            $dat = collect();
            $dat->put('id',$question->id);
            //$dat->put('title',$question->title);
            //$dat->put('description',$question->description);
            $dat->put('image_src',$question->image_src);
            $dat->put('text',$question->text);
            $return->push($dat->shuffle());
        }
        $this->data = $return;
    }

    public function object(){
        $data = get_object_vars($this);
        unset($data['object']);
        return $data;
    }
}
