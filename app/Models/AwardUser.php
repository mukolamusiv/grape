<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AwardUser extends Model
{
    use HasFactory;

    public function Awards(){
        return $this->hasMany(Awards::class,'id','award_id');
    }
}
