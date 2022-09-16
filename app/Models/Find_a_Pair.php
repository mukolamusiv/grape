<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Find_a_Pair extends Model
{
    use HasFactory;

    public function data(){
        return $this->hasMany(Find_a_Pair_Data::class,'find_a_pair','id');
    }
}
