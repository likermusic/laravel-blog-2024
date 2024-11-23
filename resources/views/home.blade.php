@extends('layouts.layout')

@section('title', 'Home')



@section('register-alert')
  @if (session()->has('success'))
    <div class="alert alert-success">{{session('success')}}</div>
  @endif
@endsection

@section('fail')
  @if (session()->has('fail'))
    <div class="alert alert-danger">{{session('fail')}}</div>
  @endif
@endsection

@section('content')
    @foreach ($posts as $post)
    <div class="card" style="width: 18rem;">
        <img src="{{ $post->image ? asset("img/{$post->image}") :  asset("img/no-photo.jpg")}}" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">{{ $post->title }}</h5>
          <i class="btn btn-sm btn-primary rounded-pill">{{$post->category->name}}</i>
          <p class="card-text">{{ $post->description }}</p>
          <a href="#" class="btn btn-primary">Читать далее</a>

          <form class="d-inline-block" action="{{route('post.store')}}" method="post">
            @csrf
            <input type="hidden" name="postId" value="{{$post->id}}">
            {{--contains - проверяет в коллекции полученной через Eloquent есть ли в массиве favourites пост с таким id  --}}
            @if ($favourites->contains($post->id))
              @method('DELETE')
            <button class="d-inline-block btn btn-success remove-favourites" type="submit">Удалить из избранного</button>    
            @else
              <button class="d-inline-block btn btn-warning add-favourites" type="submit">В избранное</button>
            @endif
          </form>
        </div>
      </div>
    @endforeach
@endsection