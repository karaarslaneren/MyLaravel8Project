<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Result;
use App\Models\User;
use App\Models\UserAnswers;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MainController extends Controller
{
    public function dashboard()
    {
        $results = Result::orderByDesc('point')->take(10)->get();
        $quizzes = Quiz::where('status','publish')
        ->where(function($query){
            $query->whereNull('finished_at')->orWhere('finished_at','<',now());
        })->withCount('questions')
        ->paginate(5);
        return view('dashboard',compact(['quizzes','results']));
    }
    public function quiz($slug){
        $quiz = Quiz::whereSlug($slug)->with('questions.myAnswer','myResult')->first();
        if($quiz->myResult){
            return view('quiz_result',compact('quiz'));
        }
        return view('quiz',compact('quiz'));
    }
    public function quiz_detail($slug){
       $quiz = Quiz::whereSlug($slug)->with(['myResult','topTen.user'])->withCount('questions')->first() ?? abort(404,'Quiz Bulunamad─▒');
        return view('quiz_detail',compact('quiz'));
    }
    public function result(Request $request, $slug)
    {
        $quiz = Quiz::with(['questions','questions.answers'])->whereSlug($slug)->first() ?? abort(404,'Quiz Bulunamad─▒');
        $correct = 0;
        foreach($quiz->questions as $question){
            foreach($question->answers as $answer){
                UserAnswers::create([
                    'user_id'=>auth()->user()->id,
                    'question_id'=>$question->id,
                    'answer'=>$request->post($question->id)
                ]);
            }
            
            if($answer->correct_answer===$request->post($question->id)){
                $correct+=1;
            }
        }
        $point = round((100 / count($quiz->questions)) * $correct);
        $wrong = count($quiz->questions)-$correct; 
        Result::create([
            'user_id' => auth()->user()->id,
            'quiz_id'=>$quiz->id,
            'point'=>$point,
            'correct_answer'=>$correct,
            'wrong_answer'=>$wrong,
        ]);
        return redirect()->route('quiz.detail',$quiz->slug)->withSuccess("Ba┼čar─▒yla Quiz'i bitirdin. Puan─▒n: ".$point);
    }
    public function stats(Request $request)
    {
        $quizzes = Quiz::has('results');
        if($request -> get('title'))
        {
            $quizzes= $quizzes->where('title','LIKE',"%".$request->get('title')."%");
        }
        if($request -> get('status'))
        {
            $quizzes= $quizzes->where('status',$request->get('status'));
        }
        $quizzes = $quizzes->paginate(5);
        return view('admin.stats',compact('quizzes'));
    }
    public function userCreateQuestion(Request $request)
    {
        $quizzes = Quiz::all();
        return view('user.question.create',compact('quizzes'));
    }
}
