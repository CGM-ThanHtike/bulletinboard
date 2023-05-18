@extends('layouts.app')
@section('content')
@include('include.messages')

{{-- <a href="{{route('posts.create')}}">Create Post</a> --}}

{{-- @if( Auth::user()->role == '1' && count($posts) > 0) --}}

    
    <div class="container">
        <div class="main-header mb-4 fw-bold"><a href="{{route('posts')}}"><h1>投稿管理</h1></a></div>
        <div class="search-section bg-light rounded-3">
            <div class="section-inner row justify-content-center">
                {{-- search section come here --}}
            </div>
        </div>
        <div class="middle-section py-5">
            <div class="row justify-content-between">
                <div class="col-4 col-lg-2">検索結果： <span class="mx-1">90</span>件</div>
                <div class="btn-group col-4 col-lg-3" role="group" aria-label="Basic outlined example">
                    <a class="btn btn-outline-primary" href="/"><i class="fa-sharp px-2 fa-solid fa-arrow-up"></i>アップロード</a>
                    <a class="btn btn-outline-primary" href="/"><i class="fa-sharp px-2 fa-solid fa-arrow-down"></i>ダウンロード</a>
                </div>
                <div class="col-4 col-lg-2 d-flex justify-content-end">
                    <a class="btn btn-primary" href="{{route('posts.create')}}"><i class="me-2 fa-solid fa-circle-plus"></i>新規作成</a>
                </div>
            </div>

        </div>
        <div class="post-list-table">
        
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
                    @if(count($posts) > 0)
                    @foreach($posts as $post)
                    <tr>
                        <td class="text-center align-middle">{{$post->title}}</td>
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
                    @endforeach
                    @endif
                </tbody>
               
            </table>
        {{$posts->links()}}
        </div>

    </div>

    
 

@endsection