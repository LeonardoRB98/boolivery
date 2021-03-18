@extends('layouts.main')

@section('content')

    <div class="clearfix mb-4">
        <a href="{{ route('admin.restaurants.index') }}" class="btn btn-primary float-right">Elenco Ristoranti</a>
    </div>

 <div class="container text-center">
     <h1>{{$restaurant->name}}</h1>
     @if (!is_null($restaurant->photo))
        <img style="width: 200px" class="img-fluid" src="{{ asset('storage/'. $restaurant->photo) }}" alt="{{ $restaurant->name }}">
     @else
        <img style="width: 200px" class="img-fluid" src="{{ asset('image/download.png') }}" alt="{{ $restaurant->name }}">
    @endif
    @if (!is_null($restaurant->photo_jumbo))
        <img style="width: 200px" class="img-fluid" src="{{ asset('storage/'. $restaurant->photo_jumbo) }}" alt="{{ $restaurant->name }}">
    @else
        <img style="width: 200px" class="img-fluid" src="{{ asset('image/download.png') }}" alt="{{ $restaurant->name }}">
    @endif
    <h3>{{$restaurant->address}}</h3>
    <h3>{{$restaurant->email}}</h3>
    <h3>{{$restaurant->p_iva}}</h3>
    <h3>{{$restaurant->phone}}</h3>
    <h3> Sponsorizzazione:  {{ $restaurant->sponsored ? 'sponsored' : 'no' }}</h3>
    <ul>
        @foreach ($restaurant->categories as $category)
            <li>{{$category->category}}</li>
        @endforeach
    </ul>
    {{-- <a href="{{route("admin.plates.showPlates", ['restaurant_id' => $restaurant->id])}}">I TUOI PIATTI</a> --}}
    <div class="container">
        {{-- errori --}}
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
                        <a href="{{ route('admin.plates.edit', $plate) }}">Modifica</a>
                    </td>
                    <td>
                        <form action="{{ route('admin.plates.destroy', $plate) }}" method="POST">
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
 </div>

@endsection
