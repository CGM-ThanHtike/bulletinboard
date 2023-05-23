@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-10 col-md-8 col-xl-6">
            <div class="card">
                <div class="card-header text-center fw-semibold">{!! __('社内OJT <br> Bulletin Board') !!}</div>

                <div class="card-body pt-5">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3 justify-content-center">
                            <div class="col-11 col-sm-9">
                                <input id="email" type="email" class="mb-3 form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="メールアドレス" autofocus>  
                                <div class="form-group has-feedback position-relative">
                                  <input id="password" type="password" class="mb-4 form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required autocomplete="password" placeholder="パスワード">
                                  <i class="fa-regular fa-eye glyphicon form-control-feedback position-absolute top-50 translate-middle-y end-0 pe-3 opacity-50"></i>
                                </div>
                                {{-- showing mail and password erros --}}
                                @error('email')
                                    <span class="invalid-feedback mb-2" role="alert">
                                        <strong>{{ __('メールアドレス、またはパスワードが正しくありません。') }}</strong>
                                    </span>
                                @enderror
                                @error('password')
                                    <span class="invalid-feedback mb-2" role="alert">
                                        <strong>{{ __('メールアドレス、またはパスワードが正しくありません。') }}</strong>
                                    </span>
                                @enderror
                            
                                <button type="submit" class="btn btn-primary w-100">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>

                        <div class="row mb-3 justify-content-center">
                            <div class="col-8 text-center">
                                @if (Route::has('password.request'))
                                <a class="btn btn-link text-decoration-none" href="{{ route('password.request') }}">
                                    {{ __('パスワードを忘れの方はこちら') }}
                                </a>
                            @endif
                            </div>
                        </div>
                    
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
  <script src="{{ asset('js/password-show-hide.js') }}"></script>
@endsection
