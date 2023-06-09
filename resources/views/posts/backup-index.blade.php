@extends('layouts.app')
@section('content')
@include('include.messages')

<h1>All posts lists</h1>
<a href="{{route('posts.create')}}">Create Post</a>

@if(Auth::user()->role == '1' && count($posts) > 0)
    @foreach($posts as $post)
      <div class="card mb-3">
        <h4 class="card-header">{{$post->title}}
            @if($post->status === 1)
            <span class="badge bg-success">Published</span>
        @else
            <span class="badge bg-secondary">Draft</span>
        @endif
        </h4>
        
        <div class="card-body">
        <a href="/posts/{{$post->id}}">
          <p class="card-text">{{$post->description}}</p>
        </a>
        <small>written by {{$post->user->name}} <strong>{{$post->created_at->format('d.m.Y H:i')}}</strong></small>
        </div>
      </div>
    @endforeach
    {{$posts->links()}}
  @endif

  @if(Auth::user()->role == '2')
    @foreach($posts as $post)
    @if($post->created_user_id == Auth::user()->id)
    <div class="card mb-3">
        <h4 class="card-header">{{$post->title}}
            @if($post->status === 1)
            <span class="badge bg-success">Published</span>
        @else
            <span class="badge bg-secondary">Draft</span>
        @endif
        </h4>

        <div class="card-body">
        <a href="/posts/{{$post->id}}">
        <p class="card-text">{{$post->description}}</p>
        </a>
        <small>written by {{$post->user->name}} <strong>{{$post->created_at->format('d.m.Y H:i')}}</strong></small>
        
        </div>
    </div>
    @endif
    @endforeach
    {{$posts->links()}}
  @endif

@endsection