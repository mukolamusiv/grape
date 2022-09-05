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

//    public function audio()
//    {
//        return $this->hasOne(Attachment::class, 'id', 'record_audio')->withDefault();
//    }
}
