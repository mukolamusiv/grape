<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Screen\AsSource;

class Topic extends Model
{
    use HasFactory,AsSource, Attachable;

    protected $fillable = [
        'title',
        'description'
    ];

    public function lessons(){
        return $this->hasMany(Lessons::class,'topic_id','id');
    }

    public function complete(){
        return $this->hasMany(UserLessons::class,'topic_id','id')->with('lessons')->where('complete','=',true);
    }

}
