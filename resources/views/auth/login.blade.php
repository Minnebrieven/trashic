@extends('private.index')

@section('content')
<div class="row flex-grow">
    <div class="col-lg-4 mx-auto">
      <div class="auth-form-light text-left p-5">
        <div class="brand-logo">
          <img src="{{ asset('private/assets/img/trashic.png') }}">
        </div>
        <h4>Hello! let's get started</h4>
        <h6 class="font-weight-light">Sign in to continue.</h6>
        <form method="POST" action="{{ route('login') }}" class="pt-3" id="formLogin">
            @csrf
            <div class="form-group">
                <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email Address" autofocus>
            </div>
            <div class="form-group">
                <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
            </div>
            <div class="mt-3">
                <a class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" href="#" onclick="document.getElementById('formLogin').submit();">SIGN IN</a>
            </div>
            <div class="my-2 d-flex justify-content-between align-items-center">
                <div class="form-check">
                <label class="form-check-label text-muted">
                    <input type="checkbox" class="form-check-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> Keep me signed in </label>
                </div>
                @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="auth-link text-black">Forgot password?</a>
                @endif
            </div>
            <div class="text-center mt-4 font-weight-light"> Don't have an account? <a href="{{route('register')}}" class="text-primary">Create</a>
            </div>
        </form>
      </div>
    </div>
</div>
@endsection
