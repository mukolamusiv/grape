<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTopic extends Model
{
    use HasFactory;

    public function topic(){
        return $this->hasOne(Topic::class,'id','topic_id')->with('lessons');
    }

    public function lessons(){
        return $this->hasMany(UserLessons::class,'topic_id','topic_id');
    }
}
