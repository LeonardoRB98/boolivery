@extends('layouts.admin.main')

@section('content')
    <div class="container">
        @if (session('message'))
        <div class="alert alert-success">
        {{ session('message') }}
        </div>     
        @endif
    </div>
@endsection