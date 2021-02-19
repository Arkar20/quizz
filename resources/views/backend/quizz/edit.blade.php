@extends('backend.master')

@section('content')
@section('content')
<div class="span9">
    <div class="content">
        @if (Session::has('success'))
        <div class="alert alert-success">
            
            {{Session::get('success')}}</div>

        @endif
        <a href="{{route('quizz.index')}}" class="btn btn-success float-right">All List</a>
        <div class="module">
            <div class="module-name">
                <h3>Edit Quizz</h3>
            </div>
        
            <div class="module-body">
                <form action="{{route('quizz.update',[$quizz->id])}}"  method="POST">
                    @csrf 
                    @method('put')

                <div class="control-group">
                    <label for="">Quizz</label>
                    <div class="controls">
                    <input type="text" name="name" class="span8" value="{{$quizz->name}}">
                    </div>

                    @error('name')
                    <span class="invalid-feedback">
                        {{$message}}
                    </span>
                    @enderror
                    

                    <label for="">Description</label>
                    <div class="controls">
                        <input type="text" name="desc" class="span8" value="{{$quizz->desc}}" />
                    </div>
                    @error('desc')
                    <span class="invalid-feedback">
                        {{$message}}
                    </span>
                    @enderror

                    <label for="">Minutes</label>
                    <div class="controls">
                        <input type="number" name="minutes" class="span8"value="{{$quizz->minutes}}"">
                    </div>
                    @error('minutes')
                    <span class="invalid-feedback">
                        {{$message}}
                    </span>
                    @enderror

                    <input type="submit" class="btn btn-success" value="Update"/>
                </div>
            </form>

            </div>

        </div>
    </div>
</div>

@endsection
@endsection