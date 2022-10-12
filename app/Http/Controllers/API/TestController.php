<?php

namespace App\Http\Controllers\API;

use App\DTO\LessonDTO;
use App\DTO\TestsDTO\CrosswordDTO;
use App\DTO\TestsDTO\FindPairDTO;
use App\DTO\TestsDTO\OneWordDTO;
use App\DTO\TestsDTO\QuestionDTO;
use App\DTO\TestsDTO\QuestionsDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Test\CrosswordRequest;
use App\Http\Requests\Test\OneWordRequest;
use App\Http\Requests\Test\OpenQuestionRequest;
use App\Http\Requests\Test\PairRequest;
use App\Http\Requests\Test\QuestionRequest;
use App\Models\Answer;
use App\Models\ColoringPageAnswer;
use App\Models\Crossword;
use App\Models\Find_a_Pair_Data;
use App\Models\OneWordQuestion;
use App\Models\OpenQuestion;
use App\Models\OpenQuestionAnswerUser;
use App\Models\Question;
use App\Models\QuestionLessonsAnswer;
use App\Models\User;
use App\Models\UserLessons;
use App\Models\Word;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * @param QuestionRequest $questionRequest
     * @param $question_id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function question(QuestionRequest $questionRequest, $question_id){
        $DTO = Question::find($question_id);
        $DTO->answer;
        $DTO = new QuestionDTO($DTO);
        if($DTO->audit_answer($questionRequest->input('answer_id'))){
            $this->add_question_answer($questionRequest->input('answer_id'),$question_id,true);
            return response(['reply'=>true]);
        }else{
            $this->add_question_answer($questionRequest->input('answer_id'),$question_id);
            return response(['reply'=>false]);
        }
    }


    public function question_result($lesson_id){
        $answers = QuestionLessonsAnswer::where(['user_id'=>1,'question_id'=>$lesson_id])->get();
        $i = 0;
        foreach ($answers as $answer){
            if(!$answer->reply){
                $i++;
            }
        }
        return response(['all'=>$answers->count(),'true'=>$i]);
    }

    /**
     * @param PairRequest $pairRequest
     * @param $lesson_id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function pair(PairRequest $pairRequest,$lesson_id){
        $data = new FindPairDTO($lesson_id);
        return response(['reply'=> $data->setCompleted($pairRequest->input('answer'))]);
    }

    /**
     * @param $lesson_id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function one_word($lesson_id){
        $data = new OneWordDTO($lesson_id);
        return response($data->object());
    }

    /**
     * @param CrosswordRequest $request
     * @param $lesson_id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function one_word_answer(CrosswordRequest $request, $lesson_id){
        $data = new OneWordDTO($lesson_id);
        return response(['reply'=>$data->answer($request->input('id'),$request->input('answer'))]);
    }

    /**
     * @param CrosswordRequest $request
     * @param $lesson_id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function crossword(CrosswordRequest $request, $lesson_id){
        $data = Word::findOrFail($request->input('id'));
        $answer = mb_strtolower($request->input('answer'), 'UTF-8');
        $word = mb_strtolower($data->word, 'UTF-8');
        if($answer == $word){
            return response(['reply'=>true]);
        }else{
            return response(['reply'=>false]);
        }
    }


    /**
     * @param $answer_id
     * @param $question_id
     * @param false $reply
     * @return bool
     */
    private function add_question_answer($answer_id,$question_id,$reply = false){
        $data = new QuestionLessonsAnswer();
        $data->question_id = $question_id;
        $data->user_id = 1;
        $data->answer_id = $answer_id;
        $data->reply = $reply;
        return $data->save();
    }

    public function test(){
        $data = new FindPairDTO(13);
    }

    public function open_question(OpenQuestionRequest $request, $lesson_id){
        $data = new OpenQuestionAnswerUser();
        $data->user_id = 1;
        $data->open_question_id = $request->input('id');
        $data->audit = false;
        $data->audit_user_id = 1;
        $data->reply = false;
        $data->answer = $request->input('answer');
        $data->save();
        return response('success');
    }

    public function coloring_page(Request $request, $lesson_id){
//        $data = new ColoringPageAnswer();
//        $data->user_id = 1;
//        $data->lesson_id = $lesson_id;
//        $data->title = 'Розмальовка користувача';
//        $data->svg = $request->input('svg');
//        $data->save();
        return response($request);
    }


    public function openQuestionAudit(OpenQuestionRequest $questionRequest, $question_id){
        $data = OpenQuestionAnswerUser::find($question_id);
        $data->reply = $questionRequest->answer;
        return response($data->save());
    }
}
