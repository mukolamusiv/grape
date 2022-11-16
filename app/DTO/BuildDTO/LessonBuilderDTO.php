<?php


namespace App\DTO\BuildDTO;


use App\DTO\BuildDTO\ComponentLessonDTO\ComponentCrosswordDTO;
use App\DTO\BuildDTO\ComponentLessonDTO\ComponentFinPairDTO;
use App\DTO\BuildDTO\ComponentLessonDTO\ComponentOneWordDTO;
use App\DTO\BuildDTO\ComponetntDTO\ComponentQuestionDTO;
use Illuminate\Support\Collection;

class LessonBuilderDTO
{
    public int      $user_id;

    public int      $id;
    public int      $lesson_id;
    public string   $title;
    public string   $description;
    public int      $topic_id;
    public string   $topic_title;
    public string   $video_url;

    public bool     $lesson_completed = false;
    public bool     $video_completed = false;
    public bool     $question_completed = false;
    public bool     $crossword_completed = false;
    public bool     $coloring_page_completed = false;
    public bool     $find_couple_completed = false;
    public bool     $open_question_complited = false;
    public bool     $one_word_complited = false;

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

    public Collection $lesson;

    public function __construct(Collection $lesson, int $user_id)
    {
        $this->lesson = $lesson;
        $this->user_id = $user_id;
        $this->buildLesson();
        $this->build($lesson,$user_id);
    }

    public function build(Collection $lesson, int $user_id){
        //ініціалізація тестів
        $this->QuestionDTO = new QuestionsBuilderDTO($lesson,$user_id);
        $this->question_completed = $this->QuestionDTO->completed;
        //ініціалізація знайди пару
        $this->FindPairDTO = new ComponentFinPairDTO($lesson,$user_id);
        $this->find_couple_completed = $this->FindPairDTO->getCompleted();
        //ініціалізація кросворду
        $this->CrosswordDTO = new ComponentCrosswordDTO($lesson,$user_id);
        $this->crossword_completed = $this->CrosswordDTO->getCompleted();
        //ініціалізація одне слово
        $this->OneWordDTO = new ComponentOneWordDTO($lesson,$user_id);
        $this->one_word_complited = $this->OneWordDTO->getCompleted();

    }

    public function buildLesson(){
        $this->title = $this->lesson['title'];
        $this->lesson_id = $this->lesson['id'];
        if(!empty($this->lesson['description'])){
            $this->description = $this->lesson['description'];
        }
        $this->topic_id = $this->lesson['topic_id'];
        $this->topic_title = $this->lesson['topic']['title'];
    }

    private function setQuestion(){

    }

    public function setAnswerQuestion(){

    }

    public function getLesson(){
        $lesson = collect();
        //$lesson->push($this->FindPairDTO->object());
        //$lesson->push($this->QuestionDTO->build());
        //$lesson->push($this->CrosswordDTO->find());
        $lesson->push($this->OneWordDTO->object());
        return $lesson; //$this->QuestionDTO->build();
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
}
