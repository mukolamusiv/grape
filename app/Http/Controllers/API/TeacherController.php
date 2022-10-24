<?php

namespace App\Http\Controllers\API;

use App\DTO\LessonDTO;
use App\DTO\TestsDTO\CrosswordDTO;
use App\DTO\TestsDTO\FindPairDTO;
use App\DTO\TestsDTO\OpenQuestionDTO;
use App\DTO\TestsDTO\QuestionsDTO;
use App\Http\Controllers\Controller;
use App\Models\Coloring_Page;
use App\Models\ColoringPage;
use App\Models\Crossword;
use App\Models\Find_a_Pair;
use App\Models\Lessons;
use App\Models\Question;
use App\Models\QuestionLessonsAnswer;
use App\Models\TeacherLesson;
use App\Models\Topic;
use App\Models\User;
use App\Models\UserLessons;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
  public function getTopics(){
      return response(Topic::all());
  }

  public function getLessons($topic_id){
      $data = collect(Topic::find($topic_id));
      $data->put('lessons',TeacherLesson::where(['topic_id'=>$topic_id])->get());
      return response($data);
  }

  public function getLesson($lesson_id){
      $data = TeacherLesson::findOrFail($lesson_id);
      $d = $data->topic;
      $data->toArray();
      unset($data['lesson_id']);
      return response($data);
  }
}
