@extends('layouts.app')

@section('content')
<div class="container">
 
   <div class="card">
       <div class="card-header text-uppercase">
           {{$quizz->name}}
          Marks {{$marks}} of {{$userResult->count()}}
       </div>
       <div class="card-body">
           @foreach ($questions  as $key=>$question)
                  <h3>{{$question->question}}</h3>
                    @foreach ($question->answers as $answer)
                   
                        <p>{{$answer->answer}}
                            @if ($answer->is_correct==1)
                            <span class="text-success">Correct Answer</span>
                            @endif
                            {{-- @if ($userResult[$key]->id==$answer->id)
                            
                                <span class="text-success">V</span>
                            @endif --}}
                        </p>
                    @endforeach
           @endforeach
           
       </div>
   </div>
      
</div>
@endsection