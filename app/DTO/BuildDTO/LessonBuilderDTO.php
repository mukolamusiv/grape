<?php


namespace App\DTO\BuildDTO;


use App\DTO\BuildDTO\ComponentLessonDTO\ComponentCrosswordDTO;
use App\DTO\BuildDTO\ComponentLessonDTO\ComponentFinPairDTO;
use App\DTO\BuildDTO\ComponentLessonDTO\ComponentOneWordDTO;
use App\DTO\BuildDTO\ComponentLessonDTO\ComponentOpenQuestionDTO;
use App\DTO\BuildDTO\ComponetntDTO\ComponentQuestionDTO;
use App\Models\UserLessons;
use Illuminate\Support\Collection;

class LessonBuilderDTO
{
    public int      $user_id;

    public bool     $completed;
    public int      $id;
    public int      $lesson_id;
    public string   $title;
    public string   $description;
    public int      $topic_id;
    public string   $topic_title;
    public string   $video_url;

    public bool     $lesson_completed = false;
    public bool     $video_completed = false;
    public bool     $question_completed;// = false;
    public bool     $crossword_completed;// = false;
    public bool     $coloring_page_completed = true;// = false;
    public bool     $find_couple_completed;// = false;
    public bool     $open_question_complited;// = false;
    public bool     $one_word_complited;// = false;

    /**
     *
     * "id": 7,
    "lesson_id": 7,
    "title": "Головний тестовий урок",
    "description": "Опис уроку",
    "topic_id": 1,
    "topic_title": "Готуємося до сповіді",
    "lesson_completed": true,
    "video_url": "https://grape.chasoslov.info/storage/2022/09/12/0340ca0cc6c58b23410bbe4f96a1274143dfa30b.mp4",
    "video_completed": true,
    "question_completed": true,
    "crossword_completed": true,
    "coloring_page_completed": false,
    "find_couple_completed": true,
    "open_question_complited": true,
    "one_word_complited": true,
    "user_id": 1
     *
     *
     *
     *
     *
     */




    private object $QuestionDTO;
    private object $FindPairDTO;
    private object $OneWordDTO;
    private object $OpenQuestionDTO;
    private object $CrosswordDTO;
    private Collection $lessonUser;

    private Collection $lesson;

    public function __construct(Collection $lesson, int $user_id)
    {
        $this->lesson = $lesson;
        $this->user_id = $user_id;
        $this->buildLesson();
        $this->build($lesson,$user_id);
    }

    public function build(Collection $lesson, int $user_id){
        $data = array();
        //ініціалізація тестів
        $this->QuestionDTO = new QuestionsBuilderDTO($lesson,$user_id);
        if(!$this->QuestionDTO->empty){
            $this->question_completed = $this->QuestionDTO->completed;
            $data[] = $this->QuestionDTO->completed;
        }
        //ініціалізація знайди пару
        $this->FindPairDTO = new ComponentFinPairDTO($lesson,$user_id);
        if(!$this->FindPairDTO->empty){
            $this->find_couple_completed = $this->FindPairDTO->getCompleted();
            $data[] = $this->FindPairDTO->getCompleted();
        }
        //ініціалізація кросворду
        $this->CrosswordDTO = new ComponentCrosswordDTO($lesson,$user_id);
        if(!$this->CrosswordDTO->empty){
            $this->crossword_completed = $this->CrosswordDTO->getCompleted();
            $data[] = $this->CrosswordDTO->getCompleted();
        }
        //ініціалізація одне слово
        $this->OneWordDTO = new ComponentOneWordDTO($lesson,$user_id);
        if(!$this->OneWordDTO->empty){
            $this->one_word_complited = $this->OneWordDTO->getCompleted();
            $data[] = $this->OneWordDTO->getCompleted();
        }
        //ініціалізація відкритого питання
        $this->OpenQuestionDTO = new ComponentOpenQuestionDTO($lesson,$user_id);
        if(!$this->OpenQuestionDTO->empty){
            $this->open_question_complited = $this->OpenQuestionDTO->getCompleted();
            $data[] = $this->OpenQuestionDTO->getCompleted();
        }


        //відмітка пройденого  уроку
        $data = collect($data);
        if(count($data) === count($data->filter(function ($value){
                if($value){
                    return $value;
                }
            }))){
            if($this->video_completed){
                $this->lesson_completed = true;
                //dd($this->lessonUser['id']);
                $data = UserLessons::find($this->lessonUser['id']);
                $data->complete = true;
                $data->save();
            }
        }
    }

    public function setVideo(){
        $this->video_completed = true;
        $data = UserLessons::find($this->lessonUser->first()['id']);
        $data->check_video = true;
        return $data->save();
    }

    public function buildLesson(){
        $this->title = $this->lesson['title'];
        $this->lesson_id = $this->lesson['id'];
        if(!empty($this->lesson['description'])){
            $this->description = $this->lesson['description'];
        }
        $this->topic_id = $this->lesson['topic_id'];
        $this->topic_title = $this->lesson['topic']['title'];

        if(!empty($this->lesson['user_lesson'])){
            $this->lessonUser = collect($this->lesson['user_lesson']);
            $this->lessonUser = collect($this->lessonUser->where('user_id','=',$this->user_id)->first());
            if(isset($this->lessonUser['check_video'])){
                $this->video_completed = $this->lessonUser['check_video'];
            }
            dd($this->lessonUser);
            $this->setCompleted();
        }else{
            $data = new UserLessons();
            $data->user_id = $this->user_id;
            $data->lesson_id = $this->lesson_id;
            $data->topic_id = $this->topic_id;
            $data->check_video = false;
            $data->save();
            $this->lessonUser = collect($data);
        }

        if(isset($this->lesson['attachment'])){
            if(count($this->lesson['attachment']) != 0){
                $this->video_url = $this->lesson['attachment'][0]['url'];
            }else{
                $this->video_completed = true;
            }
        }
    }

    public function setAnswerQuestion(){

    }

    public function getLesson(){
        $lesson = collect();
        //$lesson->push($this->lessonUser);
        //$lesson->push($this->FindPairDTO->object());
        //$lesson->push($this->QuestionDTO->build());
        //$lesson->push($this->CrosswordDTO->find());
        //$lesson->push($this->OneWordDTO->object());
        //$lesson->push($this->OpenQuestionDTO->object());
        return array($this); //$this->QuestionDTO->build();
    }

    private function setCompleted(){
        //dd($this->lessonUser);
        $this->lesson_completed = $this->lessonUser['complete'];
        $this->completed = $this->lessonUser['complete'];
    }


    /**
     * @return mixed
     */
    public function getQuestion(){
        return $this->QuestionDTO->build();
    }

    public function getFindPair(){
        return $this->FindPairDTO->build();
    }

    public function getCrossword(){
        return $this->CrosswordDTO->find();
    }

    public function getOneWord(){
        return $this->OneWordDTO->object();
    }
}
