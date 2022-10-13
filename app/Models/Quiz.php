<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;
    protected $fillable=['title','description','finished_at'];

    public function questions(){
      return $this->hasManyThrough(
            Question::class,
            Answer::class,
            'question_id', // Foreign key on the environments table...
            'quiz_id', // Foreign key on the deployments table...
            'id', // Local key on the projects table...
            'id' // Local key on the environments table...
        );
    }
}
