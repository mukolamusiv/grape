<?php


namespace App\DTO\BuildDTO\ComponentLessonDTO;


use App\Models\Lessons;
use Illuminate\Support\Collection;

class ComponentOpenQuestionDTO implements \App\DTO\BuildDTO\ComponentInterfaceDTO
{

    public int $id;
    public string $question;
    public bool $completed = false;
    public bool $empty = true;
    public int $user_id;

    private $lessonDTO;
    private $questionDTO;
    private Collection $answerUser;

    /**
     *
     {
    "id": 1,
    "question": "Коли ви отримали таїнство хрещення",
    "completed": false,
    "empty": false,
    "user_id": 1
    }
     *
     */

    /**
     * @inheritDoc
     */
    public function object(): array
    {
        return array($this);
    }

    /**
     * @inheritDoc
     */
    public function find()
    {
        if(!empty($this->lessonDTO['open_qustion'])){
            $this->questionDTO = $this->lessonDTO['open_qustion'][0];
            $this->empty = false;
            $this->question = $this->questionDTO['question'];
            $this->id = $this->questionDTO['id'];
            $this->answerUser = collect($this->questionDTO['answer_user']);
            $this->setCompleted();
        }else{
            $this->empty = true;
        }
    }

    /**
     * @inheritDoc
     */
    public function __construct(Collection $lesson, int $user_id)
    {
        $this->user_id = $user_id;
        $this->lessonDTO = $lesson;
        $this->find();
    }

    /**
     * @inheritDoc
     */
    public function setAnswer($request): bool
    {
        // TODO: Implement setAnswer() method.
    }

    private function setCompleted(){
        $data = $this->answerUser->where('user_id','=',$this->user_id)->where('reply','=',true);
        if(count($data)> 0 ){
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
