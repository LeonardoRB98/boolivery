@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center wrap-box">
            <div class="col-md-6">
                <form method="POST" action="{{ route('register') }}" class="login-form">
                    @csrf
                    <h3>Register</h3>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                                placeholder="Inserisci il tuo Nome...">

                            @error('name')
                                <span class="error-form" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror"
                                name="surname" value="{{ old('surname') }}" required autocomplete="surname" autofocus
                                placeholder="Inserisci il tuo cognome...">

                            @error('surname')
                                <span class="error-form" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email...">

                        @error('email')
                            <span class="error-form" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required autocomplete="new-password" placeholder="Password...">

                        @error('password')
                            <span class="error-form" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            required autocomplete="new-password" placeholder="Conferma password...">
                    </div>
                    <div class="text-center">
                        <div class="form-group" >
                            <button type="submit" class="blue-btn">
                                Registrati
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
