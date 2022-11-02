<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'word',
        'bias',
        'cells',
    ];

    public function crossword(){
        return $this->belongsTo(Crossword::class,'crossword_id');
    }
}
