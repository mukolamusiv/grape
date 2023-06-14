<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Find_a_Pair extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
       'lesson_id'
    ];


    public function lesson(){
        return $this->hasOne(Lessons::class,'id','lesson_id');
    }

    public function data(){
        return $this->hasMany(Find_a_Pair_Data::class,'find_a_pair','id');
    }

    public function answer(){
        return $this->hasMany(PairLessonsAnswer::class,'find_a_pair_id','id');
    }
}
