<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Result extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'quiz_id',
        'point',
        'correct_answer',
        'wrong_answer',
    ];
    public function userResult(){
        return $this->hasOne(User::class,'id','user_id');
    }
    public function quizResult(){
        return $this->hasOne(Quiz::class,'id','quiz_id');
    }
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
