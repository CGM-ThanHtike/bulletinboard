@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-3">
        <div class="main-header mb-3 fw-bold d-flex justify-content-between">
            <h1 class="fs-2">ユーザープロフィール</h1>
            <a href="profile/{{$user->id}}/edit-profile" class="text-decoration-underline fw-normal">編集</a></div>
        <div class="main-section bg-light rounded-3">
           <div class="profile-photo">

           </div>
           <div class="user-data">
                <div class="data row align-items-baseline justify-content-center mb-3">
                    <h5 class="data-title col-6 text-end pe-4">氏名</h5>
                    <p class="data-body col-6 ps-4">{{ $user->name }}</p>
                </div>
                <div class="data row align-items-baseline justify-content-center mb-3">
                    <h5 class="data-title col-6 text-end pe-4">メールアドレス</h5>
                    <p class="data-body col-6 ps-4">{{ $user->email }}</p>
                </div>
                <div class="data row align-items-baseline justify-content-center mb-3">
                    <h5 class="data-title col-6 text-end pe-4">権限種別</h5>
                    <p class="data-body col-6 ps-4">{{ $user->role == 1 ? 'アドミン' : 'ユーザー' }}</p>
                </div>
                <div class="data row align-items-baseline justify-content-center mb-3">
                    <h5 class="data-title col-6 text-end pe-4">生年月日</h5>
                    <p class="data-body col-6 ps-4">{{ \Carbon\Carbon::parse($user->birthday)->format('d/m/Y') }}</p>
                </div>
                <div class="data row align-items-baseline justify-content-center mb-3">
                    <h5 class="data-title col-6 text-end pe-4">携帯電話番号</h5>
                    <p class="data-body col-6 ps-4">{{ $user->phone }}</p>
                </div>
                <div class="data row align-items-baseline justify-content-center mb-3">
                    <h5 class="data-title col-6 text-end pe-4">住所</h5>
                    <p class="data-body col-6 ps-4">{{ $user->address }}</p>
                </div>
           </div>
            
        </div>
    </div>
</div>
@endsection

{{-- 
    <div class="container">
        <div class="row justify-content-center mb-3">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Profile</div>

                    <div class="card-body">
                        <ul>
                            <li>Name: {{ $user->name }}</li>
                            <li>Email: {{ $user->email }}</li>
                            <li>Role: {{ $user->role == 1 ? 'Admin' : 'User' }}</li>
                            <li>Date of Birth: {{ $user->birthday }}</li>
                            <li>Phone Number: {{ $user->phone }}</li>
                            <li>Address: {{ $user->address }}</li>
                            <!-- Add any other user fields you want to display here -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
{{-- @endsection --}}
