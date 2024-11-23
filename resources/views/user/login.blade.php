@extends('layouts.user.auth')

@section('title', 'Login')


@section('login-validate-errors')
@if ($errors->any())
    <ul class="bg-danger col-6 p-4">
      @foreach ($errors->all() as $error)
        <li class="text-white">{{$error}}</li> 
      @endforeach
    </ul>
  @endif
@endsection

@section('login-fail-error')
    @if (session('errorLogin')) 
      <div class="alert alert-danger">{{session('errorLogin')}}</div>
    @endif
@endsection

@section('error')
    @if (session('error')) 
      <div class="alert alert-danger">{{session('error')}}</div>
    @endif
@endsection

@section('content')
  <form class="col-6" method="POST" action="{{route('user.checkLogin')}}">
    @csrf
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Email</label>
      <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ old('email') }}">
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Password</label>
      <input value="{{old('password')}}" type="password" name="password" class="form-control" id="exampleInputPassword1">
    </div>
    
    <button type="submit" class="btn btn-primary">Login</button>
  </form>
@endsection