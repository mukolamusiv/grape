<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherLesson extends Model
{
    use HasFactory;

    public function topic(){
        return $this->hasOne(Topic::class,'id','topic_id');
    }
}
