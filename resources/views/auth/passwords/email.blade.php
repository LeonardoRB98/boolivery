@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center wrap-box">
            <div class="col-md-6">
                @if (session('status'))
                    <div class="alert alert-success mb-5" role="alert">
                        {{-- {{ session('status') }} --}}
                        Mail inviata con successo!
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}" class="login-form">
                    @csrf
                    <h3>Reset Password</h3>
                    <div class="form-group row">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Inserisci email...">
                        @error('email')
                            <span class="error-form" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="blue-button">
                                Invia Recupero Password
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
