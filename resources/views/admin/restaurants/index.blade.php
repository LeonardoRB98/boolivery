@extends('layouts.main')

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
                    <td> <a href="{{route('admin.restaurants.show', $restaurant)}}">{{ $restaurant->name }}</a> </td>
                    <td>{{ $restaurant->email }}</td>
                    <td>{{ $restaurant->address }}</td>
                    <td>{{ $restaurant->phone }}</td>
                    <td>{{ $restaurant->description }}</td>

                        @if (!is_null($restaurant->photo))
                            <td>
                                <img style="width: 200px" class="img-fluid" src="{{ asset('storage/'. $restaurant->photo) }}" alt="{{ $restaurant->name }}">
                            </td>
                        @else
                            <td>
                                <img style="width: 200px" class="img-fluid" src="{{ asset('image/download.png') }}" alt="{{ $restaurant->name }}">
                            </td>
                        @endif
                        @if (!is_null($restaurant->photo_jumbo))
                            <td>
                                <img style="width: 200px" class="img-fluid" src="{{ asset('storage/'. $restaurant->photo_jumbo) }}" alt="{{ $restaurant->name }}">
                            </td>
                        @else
                            <td>
                                <img style="width: 200px" class="img-fluid" src="{{ asset('image/download.png') }}" alt="{{ $restaurant->name }}">
                            </td>
                        @endif
                    <td>
                        <a href="{{route('admin.restaurants.edit', $restaurant)}}">Modifca</a>
                    </td>
                    <td>
                        <form action="{{route('admin.restaurants.destroy', $restaurant)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Elimina">
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
