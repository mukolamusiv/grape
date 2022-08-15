<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTopic extends Model
{
    use HasFactory;


    public function topic(){
        return $this->hasMany(Topic::class,'id','topic_id');
    }
}
