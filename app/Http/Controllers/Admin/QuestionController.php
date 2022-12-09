<?php

namespace App\Http\Controllers\Admin;
use App\Models\Quiz;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionCreateRequest;
use App\Http\Requests\QuestionUpdateRequest;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $questions = Question::orderBy('id');
        if($request->get('question'))
        {
            $questions = $questions->where('question','LIKE',"%".$request->get('question')."%");
        }
        $questions = $questions->paginate(20);
        return view('admin.question.list',compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $quizzes = Quiz::all();
        return view('admin.question.create',compact('quizzes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionCreateRequest $request)
    {
        if($request->hasFile('image'))
        {
            $fileName = Str::slug($request->question).'.'.$request->image->extension();
            $fileNameWithUpload = 'uploads/'.$fileName;
            $request->image->move(public_path('/uploads'),$fileName);
            $request->merge(['image'=>$fileNameWithUpload]);
        }
        $question_id = Question::create([$request->post()]);
        Answer::create(
            [   
                'question_id' => $question_id->id,
                'answer1' => $request->answer1,
                'answer2' => $request->answer2,
                'answer3' => $request->answer3,
                'answer4' => $request->answer4,
                'image' => $request->image,
                'correct_answer' => $request->correct_answer,
            ]);
        return redirect()->route('questions.index')->withSuccess('Soru Başarıyla Eklendi');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(question $question)
    {
       return view ('admin.question.show');

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = Question::find($id) ?? abort(404,'Question Bulunamadı');
        return view('admin.question.edit',compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionUpdateRequest $request,question $question)
    {
        dd($request->all());
        if($request->hasFile('image'))
        {
            $fileName = Str::slug($request->question).'.'.$request->image->extension();
            $fileNameWithUpload = 'uploads/'.$fileName;
            $request->image->move(public_path('/uploads'),$fileName);
            $image = $request->merge(['image'=>$fileNameWithUpload]);
            $path = 'uploads/'.$fileName;
        }

        Question::whereId($question->id)->update(
            [
                'question' => $request->question,
                'image' => $path ?? $question->image,
                'quiz_id'=> $question->quiz_id,
                'status'=>1]); 
        $question->answers()->first()->update(
            [
                'answer1'=>$request->answer1,
                'answer2'=>$request->answer2,
                'answer3'=>$request->answer3,
                'answer4'=>$request->answer4,
                'correct_answer'=>$request->correct_answer,
            ]);
        return redirect()->route('questions.index')->withSuccess('Soru Başarıyla Güncellendi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(question $question)
    {
        $quiz = Quiz::find($question->quiz_id);
        $question->delete();
        return redirect()->route('questions.index',compact('quiz'))->withSuccess('Soru silme işlemi başarı ile gerçekleştirildi.');
 
    }
    public function waitingQuestion(Request $request)
    {
        $questions = Question::whereStatus(0);
        $questions = $questions->paginate(20);
        return view('admin.question.waitingQuestion',compact('questions'));
    }
    public function userQuestion(Request $request)
    {
        
        if(auth()->user()->type == 'user'){
            if($request->hasFile('image'))
        {
            $fileName = Str::slug($request->question).'.'.$request->image->extension();
            $fileNameWithUpload = 'uploads/'.$fileName;
            $request->image->move(public_path('/uploads'),$fileName);
            $image = $request->merge(['image'=>$fileNameWithUpload]);
            $path = 'uploads/'.$fileName;
        }
        $quiz = Quiz::whereStatus('publish')->inRandomOrder()->limit(1)->get();
        foreach ($quiz as $id) {
            $quiz_id = $id->id;
        }
        $question_id = Question::create([
            'question' => $request->question,
            'quiz_id' => $quiz_id,
            'status' => 0,
        ]);
        Answer::create([   
                'question_id' => $question_id->id,
                'answer1' => $request->answer1,
                'answer2' => $request->answer2,
                'answer3' => $request->answer3,
                'answer4' => $request->answer4,
                'image' => $request->image,
                'correct_answer' => $request->correct_answer
            ]);
        return redirect()->route('dashboard')->withSuccess('Soru Talebi Başarıyla Alındı');
        };
    }
    public function soruOnay($id)
    {
        $question = Question::find($id);
        $test = $question->update([
            'status' => 1
        ]);
        return redirect()->back()->withSuccess('Soruyu Onayladınız');
    }
}
