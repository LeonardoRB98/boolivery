@extends('layouts.main')


@section('content')

    <div class="container-fluid central">
        <div class="message shadow">
            @if (session('message'))
                {{ session('message') }}
            @endif
            @if (count($errors) > 0)
            @foreach ($errors->all() as $error)
                    {{ $error }}
            @endforeach
            @endif
        </div>
    </div>


@endsection
