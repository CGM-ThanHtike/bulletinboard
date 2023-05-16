@extends('layouts.app')

@section('content')

<h1>Please Confirm</h1>

<form action="{{ route('posts.store') }}" method="POST">
    @csrf
    <input type="hidden" name="title" value="{{ $post['title'] }}">
    <input type="hidden" name="description" value="{{ $post['description'] }}">
    
    <button type="submit" class="btn btn-primary">Save Post</button>
    <a href="javascript:void(0);" onclick="history.back();" class="btn btn-secondary">Go Back</a>
</form>


  
@endsection