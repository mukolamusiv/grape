<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpenQuestion extends Model
{
    use HasFactory;

    public function answerUser(){
        return $this->hasMany(OpenQuestionAnswerUser::class, 'open_question_id','id');
    }

    public function lesson(){
        return$this->hasOne(Lessons::class,'id','lesson_id');
    }
}
