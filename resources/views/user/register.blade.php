@extends('layouts.user.auth')

@section('title', 'Register')

@section('content')
  <form class="col-6" method="POST" action="{{route('user.store')}}">
    @csrf
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Email</label>
      <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Password</label>
      <input type="password" name="password" class="form-control" id="exampleInputPassword1">
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword2" class="form-label">Password confirmation</label>
      <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword2">
    </div>

    <button type="submit" class="btn btn-primary">Register</button>
  </form>
@endsection