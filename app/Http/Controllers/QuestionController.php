<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use Mockery\Matcher\Any;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions=(new Question)->getQuestion();
        // return $questions;
       return view('backend.question.index',compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.question.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$this->validatQuestion($request);
        // dd($data);
        $storequestion=(new Question)->storeQuestion($data);
        $storeanswer=(new Answer)->storeAnswer($data,$storequestion);

        return back()
                ->with('success',"Questions are registered!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        return view('backend.question.edit',compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Question $question)
    {
        $data=$this->validatQuestion($request);
        $storequestion=$question->update($data);
       Answer::where('question_id',$question->id)->delete();

       $storeanswer=(new Answer)->storeAnswer($data,$question);

        // $updateAnswer=(new Answer)->deleteAnswer($question->id);
    //    $updateanswer= $question->answers->update($data);
        // foreach($data->options as $key=>$answer){
            
        // }
        // $storeanswer=(new Answer)->storeAnswer($data,$updatequestion);
        // $storeanswer=(new Answer)->storeAnswer($data,$updatequestion);

       return back()
            ->with('success',"Infromations are updated!");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
       $question->delete();

       return back()->with('error',"Quizz is delted");
    }
    public function validatQuestion($request)
    {
            return $this->validate($request,[
                'question'=>'required|string|max:30' ,
                'quizz_id'=>'required',
                'options'=>'required|array|min:3',
                'options.*'=>'required|string|distinct',
                'correct_answer'=>'required'
            ]);
    }

}
