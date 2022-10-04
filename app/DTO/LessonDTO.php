<?php


namespace App\DTO;


use App\DTO\TestsDTO\CrosswordDTO;
use App\DTO\TestsDTO\FindPairDTO;
use App\DTO\TestsDTO\OneWordDTO;
use App\DTO\TestsDTO\QuestionsDTO;
use App\Models\Lessons;
use App\Models\UserLessons;

class LessonDTO
{
    //публічні і доступні методи як передаються на зовні для frontend
    public int $id;
    public string $title;
    public string $description;
    public string $text;
    public int $topic_id;
    public string $topic_title;
    public bool $lesson_completed;
    public string $video_url;
    public bool $video_completed = false;
    public bool $question_completed = false;
    public bool $crossword_completed = false;
    public bool $coloring_page_completed = false;
    public bool $find_couple_completed = false;
    public bool $open_question = false;
    public bool $one_word = false;
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
     * LessonDTO constructor.
     * @param int $lesson_id
     */
    public function __construct(int $lesson_id){
        $this->lesson = Lessons::find($lesson_id);
        $this->active_lesson = $this->setActiveLesson($lesson_id);
        $this->setVars();
        $this->setQuestions();
        $this->setPair();
        $this->setOneWord();
        $this->setCrossword();
    }

    /**
     * @return array
     */
    public function getLesson(){
        $data = get_object_vars($this);
        unset($data['lesson']);
        unset($data['active_lesson']);
        return $data;
    }

    /**
     *
     */
    private function setVars(){
        $this->id               = $this->lesson->id;
        $this->title            = $this->lesson->title;
        $this->description      = $this->lesson->description;
        $this->topic_id         = $this->lesson->topic_id;
        $this->topic_title      = $this->lesson->topic->title;
        $this->lesson_completed = $this->active_lesson->complete;
        $this->video_url        = $this->lesson->attachment->first()->url;
        $this->video_completed  = $this->active_lesson->check_video;
    }

    /**
     * @param $lesson_id
     * @return UserLessons
     */
    private function setActiveLesson($lesson_id){
        $data = UserLessons::where(['lesson_id'=>$lesson_id, 'user_id'=>1])->get();
        if($data->isEmpty()){
            $data_lesson = Lessons::find($lesson_id);
            $lesson = new UserLessons();
            $lesson->lesson_id = $lesson_id;
            $lesson->topic_id = $data_lesson->topic_id;
            $lesson->user_id = 1;
            $lesson->check_video = true;
            $lesson->water = 50;
            $lesson->lumen = 70;
            $lesson->save();
            return $lesson;
        }else{
            return $data->last();
        }
    }

    private function setQuestions(){
        $data = new QuestionsDTO($this->id);
        $this->question_completed = $data->completed;
    }

    private function setPair(){
        $data = new FindPairDTO($this->id);
        $this->find_couple_completed = $data->completed;
    }

    private function setOneWord(){
        $data = new OneWordDTO($this->id);
        $this->one_word = $data->completed;
    }

    private function setCrossword(){
        $data = new CrosswordDTO($this->id);
        $this->crossword_completed = $data->completed;
    }
}
