@extends('layouts.app')

@section('content')
<div class="container">
 
   <div class="card">
       <div class="card-header text-uppercase">
           {{$quizz->name}}
           
          Marks {{$marks ??''}} of {{$questions->count()}}
       </div>
       <div class="card-body">
           @foreach ($questions  as $key=>$question)
                  <h3>{{$question->question}}</h3>
                    @foreach ($question->answers as $index=>$answer)
                   
                        <p>{{$answer->answer}}
                            @if ($answer->is_correct==1)
                            <span class="text-success">Correct Answer
                                
                            @endif
                            
                            @if ($useranswer[$key]==$answer->id)
                           
                                    <span class="badge">Thick</span>
                                @endif
                            </span>
                        </p>
                    @endforeach
           @endforeach
           
       </div>
   </div>
      
</div>
@endsection