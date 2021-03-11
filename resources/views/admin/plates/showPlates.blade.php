@extends('layouts.admin.main')

@section('content')
    <div class="container">
        @if (session('message'))
        <div class="alert alert-success">
        {{ session('message') }}
        </div>
        @endif
        <div class="clearfix mb-4">
            <a href="{{ route('admin.plates.createPlate', $restaurant->id) }}" class="btn btn-primary float-right">Crea Piatto</a>
        </div>

    <h1>Tutti i tuoi piatti</h1>

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Foto</th>
                    <th>Prezzo</th>
                    <th>Descrizione</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>

@endsection
