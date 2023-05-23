@extends('layouts.app')
@section('content')
@include('include.messages')
    
    <div class="container">
        <div class="main-header mb-4 fw-bold"><h1>CSVアップロード</h1></div>
        <div class="search-section bg-light p-5 rounded-3">
            <div class="section-inner row justify-content-center">
              <form  method="POST" action="{{ route('posts.csv-upload') }}"  enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <input class="form-control mb-3" type="file" name="csv_file" id="formFile" data-browse="Select File" data-placeholder="No" >
                  <input type="submit" class="btn btn-primary" value="Upload"></input>
                </div>
              </form>
                        
            </div>
        </div>
        

@endsection