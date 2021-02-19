@extends('backend.master')

@section('content')
<div class="span9">
    @if (Session::has('success'))
    <div class="alert alert-success">
        
        {{Session::get('success')}}</div>

    @endif
    @if (Session::has('error'))
    <div class="alert alert-danger">
        
        {{Session::get('error')}}</div>

    @endif
    <div class="module">
        <div class="module-title">
           <h3>All Users</h3>
        </div>
    
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>E-mail</th>
                <th>Occupation</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Created_at</th>
                <th>Updated_at</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $key=>$user)
                <tr>
                <td>{{$key+1}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->occupation}}</td>
                <td>{{$user->address}}</td>
                <td>{{$user->phone}}</td>

                <td>{{$user->created_at}}</td>
                <td>{{$user->updated_at}}</td>
                <td>
                <a href="{{route('user.edit',[$user->id])}}" class="btn btn-primary">Edit</a>
                <form action="{{route('user.destroy',[$user->id])}}" method="POST">
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
                    <td colspan="6">There are no Users yet.</td>                    
                </tr>
                
            @endforelse
        </tbody>
    </table>
</div>
</div>

@endsection