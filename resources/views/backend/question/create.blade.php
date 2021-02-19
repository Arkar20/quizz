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
                <h3>Register Question To the Quizz</h3>
            </div>
        
            <div class="module-body">
                <form action="{{route('question.store')}}"  method="POST">
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

                    <label for="">Question</label>
                    <div class="controls">
                        <input type="text" name="question" class="span8" placeholder="Please enter quizz">
                    </div>
                  
                    @error('question')
                    <span class="invalid-feedback">
                        {{$message}}
                    </span>
                    @enderror
                    
                    <label for="">Answers</label>
                    <div class="controls">
                        @for ($i = 0; $i < 4; $i++)
                        <input type="text" name="options[]" class="span6" placeholder="Please type  answer.">
                    <input type="radio" name="correct_answer" value="{{$i}}"> This is a correct answer.
                    
                    @endfor
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