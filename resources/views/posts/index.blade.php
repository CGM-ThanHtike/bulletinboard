@extends('layouts.app')
@section('content')
@include('include.messages')

{{-- <a href="{{route('posts.create')}}">Create Post</a> --}}

{{-- @if( Auth::user()->role == '1' && count($posts) > 0) --}}

    
    <div class="container">
        <div class="main-header mb-4 fw-bold"><a href="{{route('posts')}}"><h1>投稿管理</h1></a></div>
        <div class="search-section bg-light p-4 rounded-3">
            <div class="section-inner row justify-content-center">
                <form action="{{ route('posts.search') }}" method="GET" class="row">
                    <div class="form-group col-2">
                        <input type="text" name="search" id="search" class="form-control" placeholder="検索...">
                    </div>
                    <div class="form-group col-2">
                        <select class="form-select" name="status">
                            <option value="" {{ isset($status) && $status == '' ? 'selected' : '' }}>ステータス</option>
                            <option value="1" {{ isset($status) && $status == '1' ? 'selected' : '' }}>公開</option>
                            <option value="0" {{ isset($status) && $status == '0' ? 'selected' : '' }}>未公開</option>
                        </select>                        
                    </div>
                    <button type="reset" class="btn btn-outline-info col-2 mx-2">クリア</button>
                    <button type="submit" class="btn btn-info col-2 mx-2">検索</button>
                </form>
            </div>
        </div>
        <div class="middle-section py-5">
            <div class="row justify-content-between">
                <div class="col-6 col-lg-5 d-flex align-items-center">検索結果： 
                  <span class="mx-1">
                    @if(isset($postsCount))
                        {{$postsCount}}
                    @else 0
                    @endif
                  </span>件
                  <div class="btn-group ms-3" role="group" aria-label="Basic outlined example">
                    <a class="btn btn-outline-primary" href="/"><i class="fa-sharp px-2 fa-solid fa-arrow-up"></i>アップロード</a>
                    <a class="btn btn-outline-primary" href="{{route('posts.csv-download')}}"><i class="fa-sharp px-2 fa-solid fa-arrow-down"></i>ダウンロード</a>
                  </div>
                </div>
                <div class="col-4 col-lg-2 d-flex justify-content-end">
                    <a class="btn btn-primary" href="{{route('posts.create')}}"><i class="me-2 fa-solid fa-circle-plus"></i>新規作成</a>
                </div>
            </div>

        </div>
        <div class="post-list-table">
            @if(count($posts) > 0)
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="fw-bold text-center align-middle col-2">タイトル</th>
                        <th class="fw-bold text-center align-middle col-3">投稿内容</th>
                        <th class="fw-bold text-center align-middle col-2">投稿ユーザー<br>投稿日</th>
                        <th class="fw-bold text-center align-middle col-2">更新ユーザー<br>更新日</th>
                        <th class="fw-bold text-center align-middle col-1">ステータス</th>
                        <th class="fw-bold text-center align-middle col-2"></th>
                    </tr>
                </thead>
               
                <tbody>
                    @foreach($posts as $post)
                    @if(
                    auth()->user()->role == '1' || 
                    (auth()->user()->role == '2' && auth()->user()->id === $post->created_user_id))<tr>
                    <tr>
                        <td class="text-center align-middle">
                            <a href="{{route('post.details', $post->id)}}">{{$post->title}}</a></td>
                        <td class="text-center align-middle">{{$post->description}}</td>
                        <td class="text-center align-middle"><span class="fw-medium">{{$post->user->name}}</span><br>{{$post->created_at->format('Y/m/d')}}</td>
                        <td class="text-center align-middle"><span class="fw-medium">{{$post->userUpdate->name}}</span><br>{{$post->updated_at->format('Y/m/d')}}</td>
                        <td class="text-center align-middle">
                        @if($post->status === 1)
                        <span class="badge bg-success">公開</span>
                        @else
                        <span class="badge bg-secondary">未公開</span>
                        @endif
                        </td>
                        <td class="text-center align-middle">
                            <a class="btn btn-sm btn-outline-dark me-2" href="/">
                                <i class="me-2 fa-regular fa-pen-to-square"></i>編集</a>
                            <a class="btn btn-sm btn-outline-danger" href="/">
                                <i class="me-2 fa-solid fa-trash-can"></i>削除</a>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                   
                </tbody>
               
            </table>
            @else
            <div class="alert alert-danger"><i class="fa-solid fa-triangle-exclamation me-2"></i>投稿がありません</div>
            @endif
        
        @if(isset($search) && isset($status))
            {{ $posts->appends(['search' => $search, 'status' => $status])->links() }}
        @elseif(isset($search))
            {{ $posts->appends(['search' => $search])->links() }}
        @elseif(isset($status))
            {{ $posts->appends(['status' => $status])->links() }}
        @else
            {{ $posts->links() }}
        @endif
        </div>

    </div>

@endsection