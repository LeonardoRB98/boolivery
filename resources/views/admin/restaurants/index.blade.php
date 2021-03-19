@extends('layouts.main')

@section('content')
<div id="andrea">
    <div class="container">
        @if (session('message'))
        <div class="alert alert-success">
        {{ session('message') }}
        </div>
        @endif

    <h1>I tuoi Ristoranti</h1>

    <div class="clearfix mb-4">
        <a href="{{ route('admin.restaurants.create') }}" class="btn btn-primary float-right">Crea Ristorante</a>
    </div>

    <div class="container_card">
        @foreach ($restaurants as $restaurant)
        
            <div class="card">
                <a href="{{route('admin.restaurants.show', $restaurant)}}">
                <div class="image-box">
                    @if (!is_null($restaurant->photo))
                    <img class="img-fluid" src="{{ asset('storage/'. $restaurant->photo) }}" alt="{{ $restaurant->name }}">
                    @else
                        <img src="{{ asset('image/download.png') }}" alt="{{ $restaurant->name }}">
                    @endif
                </div>
            </a>    
                
                <div class="info">
                    <h3>{{ $restaurant->name }}</h3>
                    <p>{{ $restaurant->description }}</p>
                    
                    <div class="route">
                        <a href="{{route('admin.restaurants.edit', $restaurant)}}">Modifca</a>
                    <form action="{{route('admin.restaurants.destroy', $restaurant)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Elimina">
                    </form>
                    </div>
                </div>
            </div>
         
                {{-- <tr>
                    <td> {{ $restaurant->id }}</td>
                    <td> </td>
                    <td>{{ $restaurant->email }}</td>
                    <td>{{ $restaurant->address }}</td>
                    <td>{{ $restaurant->phone }}</td>
                    <td>{{ $restaurant->description }}</td>

                       
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
                        
                    </td>
                    <td>
                        
                    </td>
                </tr> --}}
                @endforeach
    </div>


</div>
    

@endsection
