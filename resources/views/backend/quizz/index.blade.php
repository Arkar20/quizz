@extends('backend.master')

@section('content')
<div class="span9">
    
    @if (Session::has('error'))
    <div class="alert alert-danger">
        
        {{Session::get('error')}}</div>

    @endif
    <div class="module">
        <div class="module-title">
           <h3>All Quizz</h3>
        </div>
    
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Description</th>
                <th>Minutes</th>
                <th>Created_at</th>
                <th>Updated_at</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse (App\Models\Quizz::latest()->get() as $key=>$item)
                <tr>
                <td>{{$key+1}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->desc}}</td>
                <td>{{$item->minutes}}</td>

                <td>{{$item->created_at}}</td>
                <td>{{$item->updated_at}}</td>
                <td>
                <a href="{{route('quizz.edit',[$item->id])}}" class="btn btn-primary">Edit</a>
                <form action="{{route('quizz.destroy',[$item->id])}}" method="POST">
                    @csrf
                    @method('delete')
                    <td>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </td>  
                </form>
            </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">There are no quizz yet.</td>                    
                </tr>
                
            @endforelse
        </tbody>
    </table>
</div>
</div>

@endsection