@extends('layouts.main')

@section('content')
        <div class="container-fluid">
            <div class="row justify-content-center align-items-center wrap-box">
                <div class="col-md-6">
                    <form method="POST" action="{{ route('login') }}" class="login-form">
                        @csrf
                        <h3>Login</h3>
                        <div class="form-group">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" placeholder="Email..." required
                                autocomplete="email" autofocus>

                            @error('email')
                                <span class="error-form" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password" placeholder="Password...">

                            @error('password')
                                <span class="error-form" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="text-center">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>
    
                                <label class="btnForgetPwd" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                            <div class="form-group">

                                    <button type="submit" class="blue-btn">
                                        {{ __('Login') }}
                                    </button>
                                
                            </div>
                        </div>
                        <div class="form-group d-flex flex-column justify-content-between flex-md-row align-items-center">
                            <a href="{{ route('register') }}"  class="small-link" href="">Non sei ancora registrato?</a>
                            @if (Route::has('password.request'))
                                <a class="small-link" href="{{ route('password.request') }}">Password dimenticata?</a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection
