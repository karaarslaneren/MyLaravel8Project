<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Question;

class Answer extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable=[
        'question_id',
        'answer1',
        'answer2',
        'answer3',
        'answer4',
        'correct_answer',
    ];
    public function Question()
    {
        return $this->belongsTo('App\Models\Question', 'id', 'question_id');
    }
}
