@if(session()->has('alert-danger') || session()->has('alert-success'))
    <div class="container">
        @if($msg = session('alert-danger'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {!! $msg !!}
            </div>
        @endif

        @if($msg = session('alert-success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {!! $msg !!}
            </div>
        @endif
    </div>
@endif
