@extends('layouts.app')

@section('content')

<div class="main-header mb-4 fw-bold"><h1>投稿確認</h1></div>

  {{-- to take actions of form --}}
<form action="{{ route('posts.store') }}" method="POST">
    @csrf
    <input type="hidden" name="title" value="{{ $post['title'] }}">
    <input type="hidden" name="description" value="{{ $post['description'] }}">

{{-- to display disabledform --}}
    <div class="mb-3">
        <label for="title" class="form-label fw-semibold">投稿タイトル</label>
        <input type="text" class="form-control" name="title" placeholder="タイトルを入力してください" value="{{ $post['title'] }}" disabled>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label fw-semibold">投稿内容</label>
        <textarea style="height: 12rem" class="form-control" name="description" placeholder="投稿内容を入力してください" disabled>{{ $post['description'] }}</textarea>
    </div>
    {{-- <div class="form-check form-switch mb-5">
        <input class="form-check-input form-check form-switch cursor-pointer" type="checkbox" id="flexSwitchCheckChecked" name="status" value="1" checked>
        <label class="form-check-label ms-2" for="statusToggle">公開ステータス</label>
    </div>   --}}
{{-- form display end --}}
    
    <a href="javascript:void(0);" onclick="history.back();" class="btn btn-secondary me-2">戻る</a>
    <button type="submit" class="btn btn-primary">登録</button>
</form>


  
@endsection