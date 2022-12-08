<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\QuizController;
use App\Models\Quiz;
use App\Models\Question;
use App\Http\Requests\QuizCreateRequest;
use App\Http\Requests\QuizUpdateRequest;
use Carbon\Carbon;


class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $quizzes = Quiz::withCount('questions');
        if($request->get('title'))
        {
            $quizzes= $quizzes->where('title','LIKE',"%".$request->get('title')."%");
        }
        if($request -> get('status'))
        {
            $quizzes= $quizzes->where('status',$request->get('status'));
        }
        $quizzes = $quizzes->paginate(5);
        return view('admin.quiz.list',compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.quiz.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuizCreateRequest $request)
    {
        Quiz::create($request->post());
        return redirect()->back()->withSuccess('Quiz Başarıyla Oluşturuldu');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Quiz $quiz)
    {
        $questions = $quiz->questions;
        return view('admin.quiz.show',compact(['quiz','questions']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $quiz = Quiz::withCount('questions')->find($id) ?? abort(404,'Quiz Bulunamadı');
        return view('admin.quiz.edit',compact('quiz'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuizUpdateRequest $request,Quiz $quiz)
    {
        $quiz->update($request->except(['_method','_token']));
        return redirect()->route('quizzes.index')->withSuccess('Quiz güncelleme işlemi başarı ile gerçekleştirildi.'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quiz $quiz)
    {
        $quiz->delete();
        return redirect()->route('quizzes.index')->withSuccess('Quiz silme işlemi başarı ile gerçekleştirildi.'); 
    }
    public function createQuestion($id)
    {
        $quiz = Quiz::find($id)->first();
        return view('admin.quiz.question_create',compact('quiz'));
    }
    public function quizAc(Request $request){
        Quiz::find($request->id)->update([
            'status'=>'publish'
        ]);
        return redirect()->route('quizzes.index')->withSuccess('Quiz Durumu Aktif Olarak Değiştirildi.');
    }
    public function quizKapa(Request $request){
        Quiz::find($request->id)->update([
            'status'=>'passive'
        ]);
        return redirect()->route('quizzes.index')->withSuccess('Quiz Durumu Pasif Olarak Değiştirildi.');
    }
}
