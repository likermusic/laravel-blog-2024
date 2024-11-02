@extends('layouts.layout')

@section('title', 'Home')



@section('content')
    @foreach ($posts as $post)
    <div class="card" style="width: 18rem;" data-id="{{$post->id}}">
        <img src="{{ $post->image ? asset("img/{$post->image}") :  asset("img/no-photo.jpg")}}" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">{{ $post->title }}</h5>
          <i class="btn btn-sm btn-primary rounded-pill">{{$post->category->name}}</i>
          <p class="card-text">{{ $post->description }}</p>
          <a href="#" class="btn btn-primary">Читать далее</a>
          <a href="#" class="btn btn-warning add-favourites">В избранное</a>
        </div>
      </div>
    @endforeach

   


@endsection