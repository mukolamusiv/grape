<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OneWord extends Model
{
    use HasFactory;

    public function question(){
        return $this->hasMany(OneWordQuestion::class,'one_word_id','id');
    }

    public function answerUser(){
        return $this->hasMany(OneWordAnswerUser::class,'one_word_id','id');
    }
}
