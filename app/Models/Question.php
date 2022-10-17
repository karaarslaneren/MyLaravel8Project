<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Answer;
class Question extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable=
    [
        'question',
        'image',
        'quiz_id'

    ];
    public function answers()
    {
        return $this->hasMany(Answer::class,'question_id','id');
    }
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
    public function AnswerOptions()
    {
        return $this->hasMany('App\Models\Answer', 'question_id')->select('id', 'answer1','answer2','answer3','answer4','correct_answer', 'question_id');
    }

}
