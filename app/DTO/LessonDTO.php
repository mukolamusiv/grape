<?php


namespace App\DTO;


use App\DTO\TestsDTO\CrosswordDTO;
use App\DTO\TestsDTO\FindPairDTO;
use App\DTO\TestsDTO\OneWordDTO;
use App\DTO\TestsDTO\OpenQuestionDTO;
use App\DTO\TestsDTO\QuestionsDTO;
use App\Models\Lessons;
use App\Models\UserLessons;
use Illuminate\Support\Facades\Auth;

class LessonDTO
{
    //публічні і доступні методи як передаються на зовні для frontend
    public int $id;
    public int $lesson_id;
    public string $title;
    public string $description = '';
    public string $text;
    public int $topic_id;
    public string $topic_title;
    public bool $lesson_completed = false;
    public string $video_url;
    public bool $video_completed = false;
    public bool $question_completed = false;
    public bool $crossword_completed = false;
    public bool $coloring_page_completed = true;
    public bool $find_couple_completed = false;
    public bool $open_question_complited = false;
    public bool $one_word_complited = false;

    private int $user_id;
    ///////////////////////////////////////////

    /**
     * @var Lessons|object
     */
    private object $lesson;
    /**
     * @var UserLessons|object
     */
    private object $active_lesson;

    /**
     * @var bool
     */
    private bool $emptyQuestion = false;
    private bool $emptyFindPair = false;
    private bool $emptyOneWord = false;
    private bool $emptyCrossword = false;
    private bool $emptyOpenQuestion = false;

    /**
     * LessonDTO constructor.
     * @param int $lesson_id
     * @param int $user_id
     */
    public function __construct(int $lesson_id, int $user_id){
        $this->user_id = $user_id;
        $this->lesson = Lessons::find($lesson_id);
        $this->active_lesson = $this->setActiveLesson($lesson_id);
        $this->setVars();
        $this->setQuestions();
        $this->setPair();
        $this->setOneWord();
        $this->setCrossword();
        $this->setOpenQuestion();
    }

    /**
     * @return array
     */
    public function getLesson(){
        $data = get_object_vars($this);

        if($this->emptyQuestion){
            unset($data['question_completed']);
        }

        if($this->emptyFindPair){
            unset($data['find_couple_completed']);
        }

        if($this->emptyOneWord){
            unset($data['one_word_complited']);
        }

        if($this->emptyCrossword){
            unset($data['crossword_completed']);
        }

        if($this->emptyOpenQuestion){
            unset($data['open_question_complited']);
        }

        unset($data['lesson']);
        unset($data['active_lesson']);

        unset($data['emptyOneWord']);
        unset($data['emptyFindPair']);
        unset($data['emptyQuestion']);
        unset($data['emptyCrossword']);
        unset($data['emptyOpenQuestion']);
        return $data;
    }

    /**
     *
     */
    private function setVars(){
        $this->id               = $this->lesson->id;
        $this->lesson_id        = $this->lesson->id;
        $this->title            = $this->lesson->title;
        $this->description      = strval($this->lesson->description);
        $this->topic_id         = $this->lesson->topic_id;
        $this->topic_title      = $this->lesson->topic->title;
        $this->setActive();
        $this->setVideo();
    }

    /**
     *
     */
    private function setActive(){
        //dd($this->active_lesson->complete);
        if(isset($this->active_lesson->complete)){
            $this->lesson_completed = $this->active_lesson->complete;
        }else{
            $this->lesson_completed = false;
        }
    }

    private function setVideo(){
        if(count($this->lesson->attachment) != 0){
            dd($this->lesson->attachment->first()->url);
            if($this->lesson->attachment->first()->url != null){
                $this->video_url = $this->lesson->attachment->first()->url;
                $this->video_completed  = $this->active_lesson->check_video;
            }else{
                $this->video_completed = true;
            }
        }else{
            $this->video_completed = true;
        }
    }

    /**
     * @param $lesson_id
     * @return UserLessons
     */
    private function setActiveLesson($lesson_id){
        $data = UserLessons::where(['lesson_id'=>$lesson_id, 'user_id'=>$this->user_id])->get();
        if($data->isEmpty()){
            $data_lesson = Lessons::find($lesson_id);
            $lesson = new UserLessons();
            $lesson->lesson_id = $lesson_id;
            $lesson->topic_id = $data_lesson->topic_id;
            $lesson->user_id = $this->user_id;
            $lesson->check_video = false;
            $lesson->water = 50;
            $lesson->lumen = 70;
            $lesson->save();
            return $lesson;
        }else{
            return $data->last();
        }
    }

    private function setQuestions(){
        $data = new QuestionsDTO($this->id,$this->user_id);
        if($data->empty){
            $this->emptyQuestion = true;
        }
        $this->question_completed = $data->completed;
    }

    private function setPair(){
        $data = new FindPairDTO($this->id,$this->user_id);
        $this->emptyFindPair = $data->empty;
        $this->find_couple_completed = $data->completed;
    }

    private function setOneWord(){
        $data = new OneWordDTO($this->id,$this->user_id);
        $this->emptyOneWord = $data->empty;
        $this->one_word_complited = $data->completed;
    }

    private function setCrossword(){
        $data = new CrosswordDTO($this->id,$this->user_id);
        $this->emptyCrossword = $data->empty;
        $this->crossword_completed = $data->completed;
    }

    private function setOpenQuestion(){
        $data = new OpenQuestionDTO($this->id,$this->user_id);
        $this->emptyOpenQuestion = $data->empty;
        $this->open_question_complited = $data->completed;
    }
}
