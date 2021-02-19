<?php

namespace App\Http\Controllers;

use App\Models\Quizz;
use Illuminate\Http\Request;

class QuizzController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.quizz.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('backend.quizz.quizz');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$this->validateQuizz($request);

        $quizz= (new Quizz)->createQuizz($data);

        return back()      
            ->with('success',"Successfully added!");
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
    public function edit(Quizz $quizz)

    {
       return view('backend.quizz.edit',compact('quizz'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Quizz $quizz)
    {
        $data=$this->validateQuizz($request);
            $quizz->update($data);

            return back()->with('success',"update Successful");
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quizz $quizz)
    {
        $quizz->delete();
        return back()->with('error','Delete successul!');
    }
    public function validateQuizz($request)
    {
     return  $this->validate($request,[
        'name'=> 'required|string|max:25',
        'desc'=> 'required|string|max:255',
        'minutes'=> 'required|integer|max:25',
       ]);
    }
}
