@if(count($errors) > 0)
    @foreach($errors->all() as $error)
        <div class="alert alert-danger">
            {{$error}}
        </div>
    @endforeach
@endif

@if(session('success'))
    <div class="alert alert-success">
		{{session('success')}}
    </div>
@endif
@push('scripts')
    @if(session('success_duration'))
    <script>
        setTimeout(function() {
            $('.alert-success').fadeOut();
        }, 3000); // Change the duration to 3000 milliseconds (3 seconds)
    </script>
    @endif
@endpush

@if(session('error'))
    <div class="alert alert-danger">
		{{session('error')}}
    </div>
    
@endif