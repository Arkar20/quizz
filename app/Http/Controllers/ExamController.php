<?php

namespace App\Http\Controllers;

use auth;
use App\Models\User;
use App\Models\Quizz;
use App\Models\Answer;
use App\Models\Result;
use App\Models\Question;
use Illuminate\Http\Request;

use Laravel\Ui\Presets\React;
use Illuminate\Support\Facades\DB;

class ExamController extends Controller
{
    public function create()
    {
        return view('backend.exam.create');
    }
    public function store(Request $request)
    {
        // dd($request->all());
       $quizz=Quizz::find($request->quizz_id);
       $quizz->users()->syncWithoutDetaching($request->user_id);

        return back()->with('success','Exam is assigned');
    }
    public function index()
    {
        return view('backend.exam.index',[
            'quizzs'=>Quizz::get()
        ]);
    }
    public function questions(Quizz $quizz)
    {
        // dd($quizz->questions);
        return view('backend.exam.question',[
            'questions'=> $quizz->questions
        ]);
    }
    public function remove(Request $request)
    {
       $userid=$request->get('user_id');
       $quizzid=$request->get('quizz_id');
       
       $exam=Quizz::find($quizzid);
       $result=Result::where('quizz_id',$quizzid)->where('user_id',$userid)->exits();

       if($result){
        return back()->with('error',"Cannot Remove Exam. Students Are Already registered to tgis. ");
    
       }
       $exam->users()->detach($userid);

       return back()->with('error',"Exam is removed.");
    }

    public function startQuizz(Quizz $quizz)
    {
        $question=Question::where('quizz_id',$quizz->id)->with('answers')->get();
        $time=Quizz::where('id',$quizz->id)->value('minutes');
        // dd($time);
        $authuser=auth()->user()->id;

        $userHasAissnged=DB::table('quizz_users')->where('user_id',$authuser)->where('quizz_id',$quizz->id)
                ->exists();
        if(!$userHasAissnged){
            return redirect('/home')->with("info",'This user is not assigned to the quizz');
        }
       
        $hasAnswered=DB::table('results')->where(['user_id'=>$authuser,'quizz_id'=>$quizz->id])->exists();
        if($hasAnswered){
            return  redirect('/home')->with('info',"This user has already answered this quizz");
        }

        
            return view('backend.exam.start',compact('quizz','question','time','hasAnswered'));

        
    
}
    public function register(Request $request)
    {
        $quizzid=$request['quizzid'];
        $questionid=$request['questionid'];
        $answerid=$request['answerid'];
        $authuser=auth()->user();

        Result::updateOrCreate([
            'user_id'=> $authuser->id,
            'question_id'=>$questionid,
            'quizz_id'=>$quizzid
        ],
        ['answer_id'=>$answerid]
    );
    }
    public function showresult(User $user,Quizz $quizz)
    {
        // questions  data
        $result = DB::table('quizz_users')->where('user_id', $user->id)->where('quizz_id', $quizz->id)->pluck('quizz_id');
        $questionWithAnswers = Question::wherein('quizz_id', $result)->with('answers')->get();
       

        // get the answer id from the result table 
        // increase if correct
        // return only correct answers


return $questionWithAnswers;
    //     $resultids=[];
    //    $result=DB::table('quizz_users')->where('user_id',$user->id)->where('quizz_id',$quizz->id)->pluck('quizz_id');
    //    $question=Question::wherein('quizz_id',$result)->get();
    //                 // retieving the correct answer
    //     $questions=$quizz->questions;
    //     $userResult=Answer::where('id', $question->id)->get();
        $marks=0;
        foreach($questionWithAnswers->answers as $correctanswer){
            // dd($correctanswer->is_correct);
            if($correctanswer->is_correct==1){
                $marks++;
            }
        }
        dd($result);

        return view('backend.exam.result',compact('quizz','questions','userResult','marks'));
    }
}
