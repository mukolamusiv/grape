<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crossword extends Model
{
    use HasFactory;

    public function word(){
        return $this->hasMany(Word::class,'crossword_id','id');
    }
}
