@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="main-header mb-3 fw-bold"><h1>ホームページ</h1></div>
        <div class="main-section bg-light rounded-3">
            <div class="section-inner row justify-content-center">
                
                <div class="total-user inner-box text-center col-md-4">
                    <div class="box-body bg-body-secondary p-5">
                        <h2 class="box-title fw-semibold fs-3">ユーザー数</h2>
                        <div class="count">
                            <span class="count-text fw-semibold me-2">{{$users->count()}}</span><span>件</span>
                        </div>
                       
                        <a href="/" @if(Auth::user()->role == '2') class="invisible"@endif>ユーザー管理へ</a>
                       
                    </div>
                </div>
                
                <div class="total-post inner-box text-center col-md-4">
                    <div class="box-body bg-body-secondary p-5">
                        <h2 class="box-title fw-semibold fs-3">投稿数</h2>
                        <div class="count">
                            <span class="count-text fw-semibold me-2">{{ $user->posts->count() }}
                            </span><span>件</span>
                        </div>
                        <a class="text-decoration-underline" href="{{route('posts')}}">投稿管理へ</a>
                    </div>
                </div>
                <div class="user-post .nner-box  text-center col-md-4">
                    <div class="box-body bg-body-secondary p-5">
                        <h2 class="box-title fw-semibold fs-3">自分の投稿数</h2>
                        <div class="count">
                            <span class="count-text fw-semibold me-2">10</span><span>件</span>
                        </div>
                        <a class="text-decoration-underline" href="http:/">新規投稿</a>
                    </div>
                </div>


            </div>









           
                
            {{-- showing section status --}}
            {{-- <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                {{ __('You are logged in as Admin!') }}
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                <a href="{{ route('register') }}">Register Now</a>
                <a href="{{ route('user.profile', ['id' => Auth::id()]) }}">My Profile</a>
                <a href="{{ route('admin.profile') }}">View Profile</a>
                <a href="{{ route('profile') }}">View Profile</a>
            </div> --}}
            
        </div>
    </div>
</div>
@endsection
