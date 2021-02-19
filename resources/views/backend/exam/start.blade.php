@extends('layouts.app')

@section('content')

<div class="container">
        
    <div class="container">
        @if (Session::has('info'))
        <div class="alert alert-success">
            
            {{Session::get('info')}}</div>

        @endif
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8 ">
            <div class="container">
              

                
<question-component
            :time="{{$time}}"
            :question="{{$question}}"
            :quizzdata="{{$quizz}}"
></question-component>
                  
              
                      
                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
