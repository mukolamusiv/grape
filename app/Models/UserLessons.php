<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLessons extends Model
{
    use HasFactory;

    public function lesson(){
        return $this->hasOne(Lessons::class,'id','lesson_id')->with('topic', 'attachment', 'question');
    }

    public function topic(){
        return $this->hasOne(Topic::class,'id','topic_id');
    }

    public function topic_active(){
        return $this->hasOne(UserTopic::class,'id','topic_active_id')->with('lessons');
    }
}
