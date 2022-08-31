<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLessons extends Model
{
    use HasFactory;

    public function lessons(){
        return $this->hasMany(Lessons::class,'id','lesson_id');
    }
}
