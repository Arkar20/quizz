@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 ">
            <div class="container">
             
                @if (Session::has('info'))
                <div class="alert alert-danger">
                    
                    {{Session::get('info')}}</div>
        
                @endif

                   @forelse ($quizzs as $key=>$item)
                   <div class="card  mb-4">
                       <div class="card-header">
                        <h3>{{$item->name}}</h3>
                        <h4>{{$item->desc}}</h4>

                       </div>
                       <div class="card-body">
                         Total Questions : <span>{{$item->questions->count()}}</span>
                       <p>Time : <span>{{$item->minutes}} Minutes</span></p> 

                       </div>
                       <div class="card-footer">

                            <a href="" class="btn btn-dark disabled" > Completed</a>
                            <a href="{{route('show.result',[auth()->user()->id,$item->id])}}" class="float-right">View Result</a>
                            {{-- <a href="{{route('show.result'),[auth()->user()->id,$item->id]}}" class="float-rigght" > View Result</a> --}}

                            <a href="{{route('quizz.enter',$item->id)}}" class="btn btn-primary"> Start Quizz</a>

                       </div>
                   </div>

                   @empty
                       
                   @endforelse
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Profile
                    </div>
                    <div class="card-body">
                      <p>Name:  {{auth()->user()->name}} </p>
                      <p>E-mail:  {{auth()->user()->email}} </p>
                      <p>Occupation:  {{auth()->user()->occupation}} </p>
                      <p>Address:  {{auth()->user()->address}} </p>
                      <p>Phone:  {{auth()->user()->phone}} </p>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
