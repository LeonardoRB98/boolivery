@extends('layouts.main')

@section('content')
<div id="andrea">
    <div class="container">
        @if (session('message'))
        <div class="alert alert-success">
        {{ session('message') }}
        </div>
        @endif

    <div class="fail" v-if="filteredRestaurants.length == 0">
        <h2>Non hai ancora inserito nessun ristorante</h2>
        <a href="{{ route('admin.restaurants.create') }}" class="btn btn-primary">Crea Ristorante</a>
    </div>
    <div class="clearfix mb-4 col-sm-12" v-else>   
        <h1 class="col-sm-4 col-xs-12">I tuoi Ristoranti</h1>
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
                    <div class="name">
                        <a href="{{route('admin.restaurants.show', $restaurant)}}"><h3>{{ $restaurant->name }}</h3></a>
                        <p>{{ $restaurant->description }}</p>
                    </div>
                    
                    
                    <div class="route">
                        <a href="{{route('admin.restaurants.edit', $restaurant)}}"><i class="fas fa-edit"></i></a>
                    <form action="{{route('admin.restaurants.destroy', $restaurant)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" value="Elimina"><i class="fas fa-trash"></i>
                        </button>
                    </form>
                    </div>
                    <div class="orange">
                        @if ($restaurant->sponsored     ==   1) 
                            <img src="https://img.icons8.com/flat-round/452/rubber-duck--v1.png" alt="" class="active">
                        @endIf
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
