<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Lessons extends Model
{
    use HasFactory,AsSource,Filterable,Attachable;

    protected $fillable = [
        'title',
        'description',
        'text',
        'points',
        'level',
        'record_audio',
        'topic_id'
    ];

    /**
     * The attributes for which you can use filters in url.
     *
     * @var array
     */
    protected $allowedFilters = [
        'id',
        'title',
        'description',
        'points',
        'level',
        'record_audio',
        'topic_id',
    ];

    /**
     * The attributes for which can use sort in url.
     *
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'title',
        'description',
        'points',
        'level',
        'record_audio',
        'topic_id',
        'updated_at',
        'created_at',
    ];


    public function topic(){
        return $this->belongsTo(Topic::class,'topic_id');
    }

    public function question(){
        return $this->hasMany(Question::class,'lesson_id')->with('answer','user_answer');
    }

    public function find_to_pair(){
        return $this->hasMany(Find_a_Pair::class, 'lesson_id')->with('data','answer');
    }

    public function UserLesson(){
        return $this->hasMany(UserLessons::class,'lesson_id','id');
    }

    public function crossword(){
        return $this->hasMany(Crossword::class,'lesson_id','id')->with('word','answerUser');
    }

    public function OneWord(){
        return $this->hasMany(OneWord::class,'lesson_id','id')->with('question','answerUser');
    }

    public function openQustion(){
        return $this->hasMany(OpenQuestion::class,'lesson_id','id')->with('answerUser');
    }
//    public function audio()
//    {
//        return $this->hasOne(Attachment::class, 'id', 'record_audio')->withDefault();
//    }
}
