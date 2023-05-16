@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ユーザー情報編集</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('user.edit-confirm', $user->id) }}">
                    {{-- <form method="POST" action="none"> --}}
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>`
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="form-select" class="col-md-4 col-form-label text-md-end">Select</label>
                            <div class="col-md-6">
                                <select class="form-select" name="role">
                                 {{--Users can't change role  --}}
                                @if(Auth::user()->role == '1' && $user->role == '1') 
                                    <option value="2">User</option>
                                    <option selected value="1">Admin</option> 
                                @elseif(Auth::user()->role == '1' && $user->role == '2')
                                    <option selected value="2">User</option>
                                    <option value="1">Admin</option> 
                                @else
                                    <option selected value="2">User</option>
                                @endif
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="birthday" class="col-md-4 col-form-label text-md-end">Birthday:</label>
                            <div class="col-md-6">
                            <input type="date" class="form-control" id="birthday" name="birthday" value="{{ $user->birthday }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="phone" class="col-md-4 col-form-label text-md-end">Phone</label>
                            <div class="col-md-6">
                                <input type="tel" class="form-control" id="phone" name="phone" value="{{ $user->phone }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="address" class="col-md-4 col-form-label text-md-end">Address</label>
                            <div class="col-md-6">
                                <textarea class="form-control" name="address" id="address" cols="30" rows="10" style="height:100px">{{ $user->address }}</textarea>
                            </div>
                        </div>

                        {{-- <div class="row mb-3">
                            <label for="profile" class="col-md-4 col-form-label text-md-end">Default file input example</label>
                            <div class="col-md-6">
                            <input class="form-control" type="file" id="profile" name="profile">
                            </div>
                        </div> --}}

                        <div class="row mb-3">
                            <label for="profile" class="col-md-4 col-form-label text-md-end">Profile</label>

                            <div class="col-md-6">
                            <input type="text" class="form-control" id="profile" name="profile" value="{{ $user->profile }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" value=""
                                 class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" value=""
                                 class="form-control @error('password') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('確認') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
