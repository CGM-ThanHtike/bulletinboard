@extends('layouts')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h1>{{$user->'name'}}</h1></div>

                <div class="card-body">
             
                    <a href="{{ route('register') }}">Register Now</a>
    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection