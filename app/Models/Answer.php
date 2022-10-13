<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable=
    [
        'answer1',
        'answer2',
        'answer3',
        'answer4',
        'correct_answer',
        

    ];
}
