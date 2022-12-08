<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\QuizController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Admin\QuestionController;
use RealRashid\SweetAlert\Facades\Alert;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::group(['middleware' => 'auth'],function(){

    Route::get('panel',[MainController::class,'dashboard'])->name('dashboard');
    Route::get('quiz/detay/{slug}',[MainController::class,'quiz_detail'])->name('quiz.detail');
    Route::get('quiz/{slug}',[MainController::class,'quiz'])->name('quiz.join');
    Route::post('quiz/{slug}/result',[MainController::class,'result'])->name('quiz.result');
});


Route::group(['middleware' => ['auth','isAdmin'],'prefix' => 'admin'],function()
{
    Route::resource('/quizzes', QuizController::class);
    Route::resource('/questions', QuestionController::class);
    Route::get('/stats',[MainController::class,'stats'])->name('admin.stats');
    Route::get('quiz/{id}/createquestion',[QuizController::class,'createQuestion'])->name('question_create');
});

