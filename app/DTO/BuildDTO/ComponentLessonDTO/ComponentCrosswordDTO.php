<?php


namespace App\DTO\BuildDTO\ComponentLessonDTO;


use App\Models\CrosswordLessonsAnswer;
use App\Models\Lessons;
use App\Models\Word;
use Illuminate\Support\Collection;

class ComponentCrosswordDTO implements \App\DTO\BuildDTO\ComponentInterfaceDTO
{

    public int $id;
    public int $lesson_id;
    public string $title;
    public string $description;
    public int $max_characters = 0;
    public int $main_word_shift = 3;
    public bool $completed = false;
    public Collection $questions;

    private $questionDTO;
    private Collection $lesson;
    private int $user_id;
    private Collection $crosswordDTO;
    private Collection $answerUserDTO;

    /**
     *
     *
    "id": 1,
    "lesson_id": 13,
    "title": "Тестовий кросворд",
    "description": "Опис",
    "max_characters": 10,
    "main_word_shift": 3,
    "completed": false,
    "questions": [
    {
    "id": 1,
    "question_text": "Тест 1",
    "shift": 4,
    "characters": 6,
    "answer": ""
    },
    {
    "id": 3,
    "question_text": "asdasd",
    "shift": 5,
    "characters": 4,
    "answer": ""
    }
    ],
    "empty": false,
    "user_id": 1
     *
     *
     *
     */




    /**
     * @inheritDoc
     */
    public function object(): array
    {
        $word = $this->buildWords($this->crosswordDTO['word']);
        $data = array();
        $data['id'] = $this->crosswordDTO['id'];
        $data['lesson_id'] = $this->crosswordDTO['lesson_id'];
        $data['title'] = $this->crosswordDTO['title'];
        $data['description'] = $this->crosswordDTO['description'];
        $data['max_characters'] = $this->max_characters;
        $data['main_word_shift'] = $this->main_word_shift;
        $data['completed'] = $this->completed;
        $data['word'] = $word;
        return $data;
    }

    /**
     * @inheritDoc
     */
    public function find()
    {
        if(!empty($this->lesson['crossword'])){
            $this->crosswordDTO = collect($this->lesson['crossword'][0]);
            $this->answerUserDTO = collect($this->lesson['crossword'][0]['answer_user']);
            //return $this->crosswordDTO;
            return $this->object();
        }else{
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function __construct(Collection $lesson, int $user_id)
    {
        $this->user_id = $user_id;
        $this->lesson = $lesson;
    }

    /**
     * @inheritDoc
     */
    public function setAnswer($request): bool
    {
        $data = Word::findOrFail($request->input('id'));
        $answer = mb_strtolower($request->input('answer'), 'UTF-8');
        $word = mb_strtolower($data->word, 'UTF-8');
        if($answer == $word){
            $add = new CrosswordLessonsAnswer();
            $add->crossword_id = $this->id;
            $add->user_id = $this->user_id;
            $add->words_id = $data->id;
            $add->reply = true;
            $this->completed = true;
            return true;
        }else{
            $add = new CrosswordLessonsAnswer();
            $add->crossword_id = $this->id;
            $add->user_id = $this->user_id;
            $add->words_id = $data->id;
            $add->reply = false;
            $this->completed = true;
            return false;
        }
    }

    /**
     * @inheritDoc
     */
    public function getCompleted(): bool
    {
        return $this->completed;
    }

    private function setCompleted(){
    }

    private function buildWords($words){
        $data = collect();
        foreach ($words as $word){
            if($this->max_characters < ($word['bias']+$word['cells'])){
                $this->max_characters = $word['bias']+$word['cells'];
            }
            $datum = collect();
            $datum->put('id',$word['id']);
            $datum->put('question_text',$word['question']);
            $datum->put('shift',$word['bias']);
            $datum->put('characters',$word['cells']);
            $datum->put('answer',$word['word']);
            $data->push($datum);
        }
        return $data;
    }
}
