<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Screen\AsSource;

class Topic extends Model
{
    use HasFactory,AsSource, Attachable;

    /**
     * @var string[]
     */
    protected $fillable = [
        'title',
        'description'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function lessons()
    {
        return $this->hasMany(Lessons::class,'topic_id','id')->with('UserLesson','question', 'find_to_pair','crossword','topic');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function UserTopic()
    {
        return $this->hasMany(UserTopic::class,'topic_id','id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function UserLessons(){
        return $this->hasMany(UserLessons::class,'topic_id','id')->with('lessons');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function complete()
    {
        return $this->hasMany(UserLessons::class,'topic_id','id')->where('complete','=',true);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function active()
    {
        return $this->hasMany(UserLessons::class,'topic_id','id')->with('lessons')->where('complete','=',false);
    }

}
