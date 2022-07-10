<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Topic extends Model
{
    use HasFactory,AsSource;

    protected $fillable = [
        'title',
        'description'
    ];

    public function lessons(){
        return $this->hasMany(Lessons::class,'topic_id','id');
    }

}
