@extends('layouts.main')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="error-wrapper">
                    <h1>Pagina non trovata</h1>
                    <a class="blue-btn" href="{{ url('/Boolivery') }}">Back to Home</a>
                </div>
            </div>
            
        </div>
        
    </div>
@endsection