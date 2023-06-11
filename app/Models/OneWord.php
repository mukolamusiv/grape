<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OneWord extends Model
{

    protected $fillable = [
        'title',
        'description',
        'lesson_id'
    ];

    use HasFactory;


    public function lesson(){
        return $this->hasOne(Lessons::class,'id','lesson_id');
    }

    public function question(){
        return $this->hasMany(OneWordQuestion::class,'one_word_id','id');
    }

    public function answerUser(){
        return $this->hasMany(OneWordAnswerUser::class,'one_word_id','id');
    }
}
