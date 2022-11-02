<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'lesson_id',
        'point',
    ];


    public function answer(){
        return $this->hasMany(Answer::class,'question_id');
    }

    public function lesson(){
        return $this->hasOne(Lessons::class,'id','lesson_id')->with('question');
    }
}
