@extends('layouts.main')

@section('content')
    <div class="container">
        @if (session('message'))
        <div class="alert alert-success">
        {{ session('message') }}
        </div>
        @endif
        <div class="clearfix mb-4">
            <a href="{{ route('admin.plates.createPlate', ['restaurant_id' => $restaurant->id]) }}" class="btn btn-primary float-right">Crea Piatto</a>
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
                @foreach ($plates as $plate)
                @dd($plate)
                <tr>
                    <td> {{ $plate->id }}</td>
                    <td> <a href="#">{{ $plate->name }}</a> </td>
                    @if (!is_null($plate->photo))
                            <td>
                                <img style="width: 200px" class="img-fluid" src="{{ asset('storage/'. $plate->photo) }}" alt="{{ $plate->name }}">
                            </td>
                        @else
                            <td>
                                <img style="width: 200px" class="img-fluid" src="{{ asset('image/download.png') }}" alt="{{ $plate->name }}">
                            </td>
                        @endif
                    <td>{{ $plate->price }}</td>
                    <td>{{ $plate->description }}</td>


                    <td>
                        <a href="#">Modifca</a>
                    </td>
                    <td>
                        <form action="#" method="POST">
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
