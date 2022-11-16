<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Result;
use App\Models\UserAnswers;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function dashboard()
    {
        $quizzes = Quiz::where('status','publish')->withCount('questions')->paginate(5);
        return view('dashboard',compact('quizzes'));
    }
    public function quiz($slug){
        $quiz = Quiz::whereSlug($slug)->with('questions')->first();
        return view('quiz',compact('quiz'));
    }
    public function quiz_detail($slug){
        $quiz = Quiz::whereSlug($slug)->withCount('questions')->first() ?? abort(404,'Quiz Bulunamadı');
        return view('quiz_detail',compact('quiz'));
    }
    public function result(Request $request, $slug)
    {
        $quiz = Quiz::with(['questions','questions.answers'])->whereSlug($slug)->first() ?? abort(404,'Quiz Bulunamadı');
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
        return redirect()->route('quiz.detail',$quiz->slug)->withSuccess("Başarıyla Quiz'i bitirdin. Puanın: ".$point);
    }
}
