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
    protected $appends = ['details','my_rank','average_point'];

    public function getFinishedAtAttribute($date){
        return $date ? Carbon::parse($date): null;
    }
    public function myResult(){
        return $this->hasOne(Result::class,'quiz_id')->where('user_id',auth()->user()->id);
    }
    public function results(){
        return $this->hasMany(Result::class,'quiz_id');
    }
    public function getDetailsAttribute(){
        if($this->results()->count()>0)
        {
            return [
                'average'=> round($this->results()->avg('point')),
                'join_count'=> $this->results()->count(),
            ];
        }
        return null;
    }
    public function questions(){
        return $this->hasMany(Question::class,'quiz_id','id');
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    public function topTen(){
        return $this->results()->orderByDesc('point')->take(10);
    }
    public function getMyRankAttribute()
    {
        $rank = 0;
        foreach($this->results()->orderByDesc('point')->get() as $result)
        {
            $rank++ ;
            if(auth()->user()->id == $result->user_id)
            {
                return $rank;
            }
        }
    }

}
