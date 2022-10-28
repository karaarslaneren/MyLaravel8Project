<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
class Quiz extends Model
{
    use HasFactory;
    use Sluggable;
    protected $fillable=['title','description','finished_at','slug','status'];
    protected $dates=['finished_at'];

    public function getFinishedAtAttribute($date){
        return $date ? Carbon::parse($date): null;
    }

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
     public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
