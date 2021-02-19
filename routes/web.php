<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QuizzController;
use App\Http\Controllers\QuestionController;
use Illuminate\Routing\Route as RoutingRoute;

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



Auth::routes([
    'register'=>false,
    'reset'=>false,
    'verify'=>false
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('start/quizz/{quizz}',[ExamController::class,'startQuizz'])->name('quizz.enter');
Route::post('/result/create',[ExamController::class,'register']);
Route::get('/result/user/{user}/quizz/{quizz}',[ExamController::class,'showresult'])->name('show.result');
Route::group(['middleware' => 'admin'], function () {
    Route::get('/', function () {
        return view('admin.index');
    });
    Route::resource('quizz', QuizzController::class);
    Route::resource('question', QuestionController::class);
    Route::resource('user', UserController::class);
    Route::get('/exam/create',[ExamController::class,'create']);
    Route::get('/exam',[ExamController::class,'index']);
    Route::get('/exam/quizz/{quizz}',[ExamController::class,'questions'])->name('exam.question');
    Route::post('/exam/create',[ExamController::class,'store'])->name('exam.store');
    Route::post('/exam/remove',[ExamController::class,'remove'])->name('exam.remove');

});
