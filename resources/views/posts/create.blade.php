@extends('layouts.app')

@section('content')
@include('include.messages')
<div class="main-header mb-4 fw-bold"><h1>新規投稿</h1></div>
<form action="{{route('posts.create-confirm')}}" method="POST">
    @csrf
    <div class="mb-3">
      <label for="title" class="form-label fw-semibold">投稿タイトル</label>
      <input type="text" class="form-control" name="title" placeholder="タイトルを入力してください" value="{{old('title')}}">
    </div>
    <div class="mb-3">
      <label for="description" class="form-label fw-semibold">投稿内容</label>
      <textarea style="height: 12rem" class="form-control" name="description" placeholder="投稿内容を入力してください" >{{old('description')}}</textarea>
    </div>
    <div class="form-check form-switch mb-5">
        <input class="form-check-input form-check form-switch cursor-pointer" type="checkbox" id="flexSwitchCheckChecked" name="status" value="1" checked>
        <label class="form-check-label ms-2" for="statusToggle">公開ステータス</label>
    </div>  
    <div class="buttons"> 
    <button type="reset" class="btn btn-outline-secondary">クリア</button>
    <input type="submit" class="btn btn-primary" value="確認">
    </div> 
  </form>
  
@endsection