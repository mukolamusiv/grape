<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpenQuestionAnswerUser extends Model
{
    use HasFactory;

    public function OpenQuestion(){
        return $this->belongsTo(OpenQuestion::class,'id');
    }
}
