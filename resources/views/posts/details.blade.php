@extends('layouts.app')

@section('content')
  <a href="{{url()->previous()}}" class="btn btn-light mb-3">Go Back</a>
  <div class="card mb-2">
    <h4 class="card-header d-flex justify-content-between">{{$post->title}}
      <div class="button-group d-flex gap-3">
      <a href="/posts/{{$post->id}}/edit" class="btn btn-dark">Edit Post</a>
      {{-- <form action="{{route('posts.destroy',$post->id)}}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
      </form> --}}
    </div>
     </h4>
    <div class="card-body">
    <p class="card-text">{{$post->description}}</p>
      <hr>
      <small>written on {{$post->created_at}}</small>  
    </div>
  </div>
@endsection