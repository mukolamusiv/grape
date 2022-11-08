<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crossword extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'lesson_id',
    ];


    public function word(){
        return $this->hasMany(Word::class,'crossword_id','id');
    }

    public function answerUser(){
        return $this->hasMany(CrosswordLessonsAnswer::class,'crossword_id','id');
    }

    public function lesson(){
        return $this->belongsTo(Lessons::class,'lesson_id')->with('topic');
    }
}
