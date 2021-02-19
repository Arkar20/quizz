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
                <h3>Edit Question To the Quizz</h3>
            </div>
        
            <div class="module-body">
                <form action="{{route('question.update',[$question->id])}}"  method="POST">
                    @csrf 
                    @method('put')

                <div class="control-group">
                    <label for="">Choose Quizz</label>
                    <div class="controls">
                       <select name="quizz_id" id="" class="span8">
                            @foreach (App\Models\Quizz::all() as $item)
                       <option value="{{$item->id}}" @if($question->quizz->id==$item->id) selected @endif>{{$item->name}}</option>  
                            @endforeach

                       </select>
                    </div>

                    @error('quizz_id')
                    <span class="invalid-feedback">
                        {{$message}}
                    </span>
                    @enderror

                    <label for="">Question</label>
                    <div class="controls">
                    <input type="text" name="question" class="span8" value="{{$question->question}}">
                    </div>
                  
                    @error('question')
                    <span class="invalid-feedback">
                        {{$message}}
                    </span>
                    @enderror
                    
                    <label for="">Answers</label>
                    <div class="controls">
                        @foreach($question->answers as $key=>$answer)
                    <input type="text" name="options[]" class="span6" value="{{$answer->answer}}">
                    <input type="radio" name="correct_answer" value="{{$key}}" @if($answer->is_correct==1) checked @endif> This is a correct answer.
                    
                    @endforeach
                    </div>
                    @error('options.*')
                    <span class="invalid-feedback">
                      
                        {{$message}}
                         {{-- @endforeach --}}
                    </span>
                    @enderror  
                    @error('correct_answer')
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