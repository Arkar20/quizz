@extends('backend.master')

@section('content')
<div class="span9">
    <div class="content">
        @if (Session::has('success'))
        <div class="alert alert-success">
            
            {{Session::get('success')}}</div>

        @endif
        <div class="module">
            <div class="module-name">
                <h3>Assigning Exam to students
                    
                </h3>
            </div>
        
            <div class="module-body">
                <form action="{{route('exam.store')}}"  method="POST">
                    @csrf 

                <div class="control-group">
                    <label for="">Choose Quizz</label>
                    <div class="controls">
                       <select name="quizz_id" id="" class="span8">
                            @foreach (App\Models\Quizz::all() as $item)
                       <option value="{{$item->id}}">{{$item->name}}</option>  
                            @endforeach

                       </select>
                    </div>

                    @error('quizz_id')
                    <span class="invalid-feedback">
                        {{$message}}
                    </span>
                    @enderror


                <div class="control-group">
                    <label for="">Choose Users</label>
                    <div class="controls">
                       <select name="user_id" id="" class="span8">
                            @foreach (App\Models\User::all() as $user)
                       <option value="{{$user->id}}">{{$user->name}}</option>  
                            @endforeach

                       </select>
                    </div>

                    @error('user_id')
                    <span class="invalid-feedback">
                        {{$message}}
                    </span>
                    @enderror

                   
                    
                    
                    
                    <button type="submit" class="btn btn-success"> Submit</button>
                </div>
            </form>

            </div>

        </div>
    </div>
</div>

@endsection