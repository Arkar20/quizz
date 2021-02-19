<?php

namespace App\Http\Controllers;

use App\Models\Quizz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(auth()->user()->is_admin==1){
        return view('admin.index');
        }
        else{
//             $authuser=auth()->user()->id;
//         //    assigned Exams
//         $assignedExams=[];
//             $user=DB::table('quizz_users')->where('user_id',$authuser)->get();
//             if($user){
//                 foreach($user as $u){
//                     array_push($assignedExams,$user->quizz_id);
//                 }
//             }
//             $quizzs=Quizz::whereIn('id',$assignedExams)->get();
//             // getting the completed quizz
// $completedQuizzs=DB::table('results')->whereIn('quizz_id',$quizzs->id)
// ->whereIn('user_id',auth()->user()->id)->get();


//            dd($quizzs);
        
$authuser=auth()->user()->id;
$assignedQuizzs=DB::table('quizz_users')->where('user_id',$authuser)->get();
// retreiveing the id form assigned quizzs
$ids=[];
foreach($assignedQuizzs as $id){
    array_push($ids,$id->quizz_id);
}
$quizzs=Quizz::whereIn('id',$ids)->get();


$resultedQuizz=DB::table('results')->where('user_id',$authuser)->whereIn('quizz_id',(new Quizz)->attemptQuizz())->pluck('quizz_id')->toArray();



return view('home',compact('quizzs','resultedQuizz'));

}

    }
}
