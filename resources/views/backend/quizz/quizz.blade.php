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
                <h3>Register Quizz</h3>
            </div>
        
            <div class="module-body">
                <form action="{{route('quizz.store')}}"  method="POST">
                    @csrf 

                <div class="control-group">
                    <label for="">Quizz</label>
                    <div class="controls">
                        <input type="text" name="name" class="span8" placeholder="Please enter quizz">
                    </div>

                    @error('name')
                    <span class="invalid-feedback">
                        {{$message}}
                    </span>
                    @enderror
                    

                    <label for="">Description</label>
                    <div class="controls">
                        <input type="text" name="desc" class="span8" placeholder="Please enter quizz" />
                    </div>
                    @error('desc')
                    <span class="invalid-feedback">
                        {{$message}}
                    </span>
                    @enderror

                    <label for="">Minutes</label>
                    <div class="controls">
                        <input type="number" name="minutes" class="span8" placeholder="Please enter quizz">
                    </div>
                    @error('minutes')
                    <span class="invalid-feedback">
                        {{$message}}
                    </span>
                    @enderror

                    <input type="submit" class="btn btn-success">Register</button>
                </div>
            </form>

            </div>

        </div>
    </div>
</div>

@endsection