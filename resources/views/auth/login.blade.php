@extends('layouts.app')

@section('content')
    <div class="container" style="background-color:#1F2631">
        <br>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="row">
                <div class="col-form-label-sm col-sm-4 text-md-right">E-mail address</div>
                <div class="col-sm-4">
                    <input id="email" type="email" placeholder="name@example.com" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                </div>
            </div>

            @if ($errors->has('email'))
                <div class="errorMessage offset-md-4">
                    <strong>{{ $errors->first('email') }}</strong>
                </div>
            @endif
            <br>
            <div class="row">
                <div class="col-form-label-sm col-sm-4 text-md-right">Password</div>
                <div class="col-sm-4">
                    <input id="password" type="password" placeholder="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                </div>
            </div>

            @if ($errors->has('password'))
                <div class="errorMessage offset-md-4">
                    <strong>{{ $errors->first('password') }}</strong>
                </div>
            @endif

            <br>
            <div class="row">
                <div class="col-md-1 offset-md-4">
                <button type="submit" class="btn btn-success btn-lg">Login</button>
                </div>
                <div class="col-sm-2 text-md-left">Remember me?</div>
                <div class="text-md-left">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}
                </div>
                </div>
            </div>


        </form>

    </div>
@endsection
