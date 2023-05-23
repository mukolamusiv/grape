<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Find_a_Pair_Data extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'text',
        'pair_id',
        'find_a_pair',
    ];
}
