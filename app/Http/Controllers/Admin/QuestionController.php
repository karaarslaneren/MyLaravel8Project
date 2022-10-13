<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Answer;
use App\Http\Requests\QuestionCreateRequest;
use Illuminate\Support\Str;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $quiz = Quiz::whereId($id)->with(['questions','questions.answers'])->first() ?? abort(404,'Quiz Bulunamadı');

        return view('admin.question.list',compact('quiz'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $quiz = Quiz::find($id);
        return view('admin.question.create',compact('quiz'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionCreateRequest $request,$id)
    {
        if($request->hasFile('image'))
        {
            $fileName = Str::slug($request->question).'.'.$request->image->extension();
            $fileNameWithUpload = 'uploads/'.$fileName;
            $request->image->move(public_path('/uploads'),$fileName);
            $request->image=$fileNameWithUpload;
        }
        $quiz = Quiz::find($id);
        $question = $quiz->questions()->create(['question' => $request->question,'image'=>$request->image,'quiz_id'=> $request->quiz_id]); 
        $question->answers()->create(
            [
                'answer1'=>$request->answer1,
                'answer2'=>$request->answer2,
                'answer3'=>$request->answer3,
                'answer4'=>$request->answer4,
                'correct_answer'=>$request->correct_answer,
            ]);
        return redirect()->route('questions.index',$id)->withSuccess('Soru Başarıyla Eklendi');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\question  $question
     * @return \Illuminate\Http\Response
     */
    public function show($quiz_id,$id)
    {
        return $quiz_id.'-'.$id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(question $question)
    {
        //
    }
}
