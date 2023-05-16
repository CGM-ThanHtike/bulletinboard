@extends('layouts.app')

@section('content')

<h1>Please create a post</h1>
<form action="{{route('posts.create-confirm')}}" method="POST">
    @csrf
    <div class="mb-3">
      <label for="title" class="form-label">Title</label>
      <input type="text" class="form-control" name="title" placeholder="Enter Title" value="{{old('title')}}">
    </div>
    <div class="mb-3">
      <label for="description" class="form-label">Body Text</label>
      <textarea style="height: 12rem" class="form-control" name="description" placeholder="Enter Body Text" >{{old('description')}}</textarea>
    </div>
    <input type="checkbox" name="status" value="1"> Publish
    <input type="checkbox" name="status" value="2"> Unpublish
    <button type="reset" class="btn btn-outline-secondary">Clear</button>
    <input type="submit" class="btn btn-primary" value="Confirm">
  </form>
  
@endsection