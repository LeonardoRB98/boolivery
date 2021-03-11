@extends('layouts.admin.main')

@section('content')
    <div class="container">
        @if (session('message'))
        <div class="alert alert-success">
        {{ session('message') }}
        </div>     
        @endif
        <div class="clearfix mb-4">
            <a href="{{ route('admin.restaurants.create') }}" class="btn btn-primary float-right">Crea Ristorante</a>
        </div>

    <h1>Tutti i Ristoranti</h1>
       
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Indirizzo</th>
                    <th>Telefono</th>
                    <th>Descrizione</th>
                    <th>
                       Foto
                    </th>
                    <th>foto back</th>
                    <th colspan="3"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($restaurants as $restaurant)
                <tr>
                    <td> {{ $restaurant->id }}</td>
                    <td> {{ $restaurant->name }} </td>
                    <td>{{ $restaurant->email }}</td>
                    <td>{{ $restaurant->address }}</td>
                    <td>{{ $restaurant->phone }}</td>
                    <td>{{ $restaurant->description }}</td>
                    <td>
                        <img class="image-fluid" src="{{ asset('storage/' . $restaurant->photo) }}" alt="">
                    </td>
                    <td>
                        <img class="image-fluid" style="width: 200px" src="{{ asset('storage/' . $restaurant->photo_jumbo) }}" alt="">
                    </td>
                    <td>
                        <a href="{{route('admin.restaurants.edit', $restaurant)}}">Mostra</a>
                    </td>
                    <td>
                        <a href="#">Modifica</a>
                    </td>
                    <td>
                        <a href="#">Cancella</a>
                    </td>
                </tr>    
                @endforeach
            </tbody>   
        </table>
    </div>

@endsection