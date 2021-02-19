
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
                <h3>Edit Of Users</h3>
            </div>
        
            <div class="module-body">
                <form action="{{route('user.update',[$user->id])}}"  method="POST">
                    @csrf 

                    @method('PUT')

                <div class="control-group">
                    <label for="">User Name</label>
                    <div class="controls">
                        <input type="text" name="name" class="span8" value="{{$user->name}}">

                    </div>

                    @error('name')
                    <span class="invalid-feedback">
                        {{$message}}
                    </span>
                    @enderror

                    <label for="">E-mail</label>
                    <div class="controls">
                        <input type="text" name="email" class="span8" value="{{$user->email}}"
                            value="{{old('email')}}"
                        >
                    </div>
                  
                    @error('email')
                    <span class="invalid-feedback">
                        {{$message}}
                    </span>
                    @enderror
                    
                    <label for="">password</label>
                    <div class="controls">
                        <input type="text" name="password" class="span8"                            value="{{old('email')}}"
                               
                                placeholder="Please enter quizz">

                    </div>
                    @error('password')
                    <span class="invalid-feedback">
                      
                        {{$message}}
                         {{-- @endforeach --}}
                    </span>
                    @enderror  
                    
                    <label for="">Occupation</label>
                    <div class="controls">
                        <input type="text" name="occupation" class="span8" value="{{$user->occupation}}">

                    </div>
                    @error('occupation')
                    <span class="invalid-feedback">
                      
                        {{$message}}
                         {{-- @endforeach --}}
                    </span>
                    @enderror  
                    <label for="">Address</label>
                    <div class="controls">
                        <input type="text" name="address" class="span8" value="{{$user->address}}">

                    </div>
                    @error('address')
                    <span class="invalid-feedback">
                      
                        {{$message}}
                         {{-- @endforeach --}}
                    </span>
                    @enderror  
                    
                    <label for="">Phone</label>
                    <div class="controls">
                        <input type="text" name="phone" class="span8"   value="{{$user->phone}}"/>                    

                    </div>
                    @error('phone')
                    <span class="invalid-feedback">
                      
                        {{$message}}
                         {{-- @endforeach --}}
                    </span>
                    @enderror  

                    <button type="submit" class="btn btn-success"> Update</button>
                </div>
            </form>

            </div>

        </div>
    </div>
</div>

@endsection