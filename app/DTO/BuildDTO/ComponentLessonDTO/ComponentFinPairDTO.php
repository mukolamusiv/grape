<?php


namespace App\DTO\BuildDTO\ComponentLessonDTO;


use App\Models\Find_a_Pair_Data;
use App\Models\Lessons;
use App\Models\PairLessonsAnswer;
use Illuminate\Support\Collection;

class ComponentFinPairDTO implements \App\DTO\BuildDTO\ComponentInterfaceDTO
{


    /**
     *
     *
     *
    "lesson_id": 13,
    "completed": false,
    "data": [
        {
        "id": 1,
        "image_src": "Перша частина",
        "text": "Перша частина"
        },
        {
        "id": 2,
        "image_src": "ідлао",
        "text": "Друга частина"
        }
    ],
    "empty": false,
    "user_id": 1
     *
     *
     */

    public int $lesson_id;

    public bool $completed = false;

    public array $data;

    public bool $empty = true;

    public int $user_id;

    public object $lesson;

    public $pairDTO;

    private Collection $answer;


    /**
     * @return array
     */
    public function object(): array
    {
        if($this->empty){
            $data = array();
            return $data;
        }else{
            $data = array();
            $data['lesson_id']  = $this->lesson_id;
            $data['completed']  = $this->completed;
            $data['data']       = $this->data;
            $data['empty']      = $this->empty;
            $data['user_id']    = $this->user_id;
            return $data;
        }
    }

    /**
     * @inheritDoc
     */
    public function find()
    {
        if(!empty($this->lesson['find_to_pair'])){
            $this->pairDTO = $this->lesson['find_to_pair'][0];
            $this->answer  = collect($this->pairDTO['answer']);
            $this->empty = false;
            $this->build();
        }else{
            $this->data  = array();
            $this->empty = true;
        }
    }

    /**
     * @inheritDoc
     */
    public function __construct(Collection $lesson, int $user_id)
    {
        $this->lesson  = $lesson;
        $this->user_id = $user_id;
        $this->find();
    }

    /**
     *
     */
    private function build(){
        $this->lesson_id = $this->pairDTO['lesson_id'];
        $this->data = $this->buildData($this->pairDTO['data']);
        $this->getAnswer($this->answer->toArray());
    }

    /**
     * @param $data
     * @return array
     */
    private function buildData($data){
        $array = array();
        foreach ($data as $datum){
            $item['id'] = $datum['id'];
            $item['image_src'] =$datum['image'];
            $item['text'] = $datum['text'];
            $array[] = $item;
        }
        return $array;
    }

    /**
     * @inheritDoc
     */
    public function setAnswer($array): bool
    {
        $pair_1 = Find_a_Pair_Data::find($array[0]);
        $pair_2 = Find_a_Pair_Data::find($array[1]);
        if($pair_1->id === $pair_2->pair_id or $pair_2->id === $pair_1->pair_id ){
            $answer = new PairLessonsAnswer();
            $answer->user_id = $this->user_id;
            $answer->find_a_pair_id = $this->pairDTO['id'];
            $answer->answer_pair_id_first = $pair_1->id;
            $answer->answer_pair_id_second = $pair_2->id;
            $answer->reply = true;
            $answer->save();
            return true;
        }else{
            $answer = new PairLessonsAnswer();
            $answer->user_id = $this->user_id;
            $answer->find_a_pair_id = $this->pairDTO['id'];
            $answer->answer_pair_id_first = $pair_1->id;
            $answer->answer_pair_id_second = $pair_2->id;
            $answer->reply = false;
            $answer->save();
            return false;
        }
    }

    /**
     * @param array $array
     */
    private function getAnswer(array $array){
        $data = collect($array);
        $data = $data->where('user_id','=',$this->user_id)->where('reply','=',true);
        if($data->isNotEmpty()){
            $this->completed = true;
        }
    }

    /**
     * @inheritDoc
     */
    public function getCompleted(): bool
    {
        return $this->completed;
    }
}
