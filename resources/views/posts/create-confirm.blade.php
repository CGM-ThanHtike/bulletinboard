@extends('layouts.app')

@section('content')

<div class="main-header mb-4 fw-bold"><h1>投稿確認</h1></div>

<form action="{{ route('posts.store') }}" method="POST">
    @csrf
{{-- to display read only --}}
    <div class="mb-3">
        <label for="title" class="form-label fw-semibold">投稿タイトル</label>
        <input type="text" class="form-control bg-secondary-subtle" name="title" placeholder="タイトルを入力してください" value="{{ $post['title'] }}" readonly>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label fw-semibold">投稿内容</label>
        <textarea style="height: 12rem" class="form-control bg-secondary-subtle" name="description" placeholder="投稿内容を入力してください" readonly>{{ $post['description'] }}</textarea>
    </div>
    <a href="javascript:void(0);" onclick="history.back();" class="btn btn-secondary me-2">戻る</a>
    <button type="submit" class="btn btn-primary">登録</button>
</form>  

@endsection