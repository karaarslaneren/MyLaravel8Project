<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Answer;
use App\Models\UserAnswers;
class Question extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable=
    [
        'question',
        'image',
        'quiz_id',
        'status',

    ];
    protected $appends = ['true_percent'];
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
    public function myAnswer()
    {
        return $this->hasOne('App\Models\UserAnswers')->where('user_id',auth()->user()->id);
    }
    public function UserAnswer()
    {
        return $this->hasMany('App\Models\UserAnswers');
    }

    public function getTruePercentAttribute()
    {
        $cevapSayisi = $this->UserAnswer()->count();
        foreach($this->answers as $answer)
        {
            $dogruCevapSayisi = $this->UserAnswer()->where('answer',$answer->correct_answer)->count();
        }
        return round((100/$cevapSayisi)*$dogruCevapSayisi);
    }
}
