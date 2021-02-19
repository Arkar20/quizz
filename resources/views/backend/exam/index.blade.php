@extends('backend.master')

@section('content')
<div class="span9">
    
    @if (Session::has('error'))
    <div class="alert alert-danger">
        
        {{Session::get('error')}}</div>

    @endif
    
    <div class="module">
        <div class="module-title">
           <h3>All Exams</h3>
        </div>
    
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No.</th>
                <th>Quizz</th>
                <th>User Name</th>
                <th>Action</th>
               
            </tr>
        </thead>
        <tbody>
            @forelse ($quizzs as $key=>$quizz)
           @forelse ($quizz->users as $user)
               
         
                
             <tr>
                <td>{{$key+1}}</td>
                <td>{{$quizz->name}}</td>
                <td>{{$user->name}}</td>
                <td>
                       <a href="{{route('exam.question',[$quizz->id])}}">View Questions</a>

                   <form action="{{route('exam.remove')}}" method="POST">
                    @csrf

                    <input type="hidden" name="user_id" value="{{$user->id}}">
                    <input type="hidden" name="quizz_id" value="{{$quizz->id}}">

                    <button type="submit" > Delete</button>
                </form>
            
            </td>
             
                </tr>
                @empty
                <p>there are no exams yet.</p>
                @endforelse

               @empty
            @endforelse
        </tbody>
    </table>
</div>
</div>

@endsection