@extends('backend.master')

@section('content')
<div class="span9">
    <div class="content">
        @if (Session::has('error'))
        <div class="alert alert-danger">
            
            {{Session::get('error')}}</div>

        @endif
        @foreach ($questions as $key=>$item)
        <div class="module">
            <div class="module-title">
                <h3>{{ $item->quizz->name}}</h3>
                <h4>{{ $item->quizz->desc}}</h4>
                <h4>{{ $item->question}}</h4>
              <div class="module-body">
              <p>Given Minutes-{{$item->quizz->minutes}}</p>
              @foreach ($item->answers as $answer)
                  <p>{{$answer->answer}}
                    @if ($answer->is_correct==1)
                    <input type="checkbox" checked> <span class="badge badge-success">Correct Answer</span>
                    @else
                    <input type="checkbox" >
                    @endif
                </p>
              @endforeach
            </div> 

       
            <a href="{{route('question.edit',[$item->id])}}" class="btn btn-primary">Edit</a>
        <form action="{{route('question.destroy',[$item->id])}}" method="POST">
            @csrf
            @method('delete')

            <button type="submit" class="btn btn-danger">delete</button>
        </form>    
        </div>
        </div>
        @endforeach
       
            
    </div>
    <div class="pagination">
        {{ $questions->links() }}

    </div>

</div>

@endsection