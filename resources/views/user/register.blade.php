@extends('layouts.user.auth')

@section('title', 'Register')



@section('register-errors')
@if ($errors->any())
    <ul class="bg-danger col-6 p-4">
      @foreach ($errors->all() as $error)
        <li class="text-white">{{$error}}</li> 
      @endforeach
    </ul>
  @endif
@endsection

@section('content')
  <form class="col-6" method="POST" action="{{route('user.store')}}">
    @csrf
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Email</label>
      <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ old('email') }}">
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Password</label>
      <input value="{{old('password')}}" type="password" name="password" class="form-control" id="exampleInputPassword1">
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword2" class="form-label">Password confirmation</label>
      <input type="password" value="{{old('password_confirmation')}}"  name="password_confirmation" class="form-control" id="exampleInputPassword2">
    </div>

    <button type="submit" class="btn btn-primary">Register</button>
  </form>
@endsection