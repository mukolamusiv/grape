<?php


namespace App\DTO\TestsDTO;


use App\Models\Lessons;

class QuestionDTO
{
    public int $id;
    /**
     * @var string
     */
    public string $title;
    /**
     * @var string
     */
    public string $description;
    /**
     * @var int
     */
    public int $lesson_id;
    /**
     * @var object
     */
    public object $answer;
    /**
     * @var bool
     */
    public bool $completed = false;
    /**
     * @var int
     */
    public int $count_question;
    /**
     * @var int
     */
    public int $count_completed_question;

    /**
     * QuestionDTO constructor.
     * @param int $lesson_id
     */
    public function __construct(int $question_id){
        $this->id = $question_id;
    }
}
