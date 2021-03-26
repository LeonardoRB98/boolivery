@extends('layouts.main')

@section('content')
    <div class="container wrapper">
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        @if (session('message_entry'))
        <div class="alert welcome">
        {{ session('message_entry') }} {{  Auth::user()->name }}!
        </div>
        @endif

        @if (!count($restaurants))
        <div class="fail">
            <h2>Non hai ancora inserito nessun ristorante</h2>
            <a class="blue-btn" href="{{ route('admin.restaurants.create') }}" class="btn btn-primary">Crea Ristorante</a>
        </div>
        
        @else
        <div class="d-flex justify-content-between align-items-center">
            <h1>I tuoi Ristoranti</h1>
            <a class="blue-button" href="{{ route('admin.restaurants.create') }}">
                <span>Crea Ristorante</span>
                <i class="fas fa-plus-square"></i>
            </a>
        </div>
            
        
        
        

        <div class="container_card">
            @foreach ($restaurants as $restaurant)
                <div class="card">
                    <a href="{{ route('admin.restaurants.show', $restaurant) }}">
                        <div class="image-box">
                            @if (!is_null($restaurant->photo))
                                <img class="img-fluid" src="{{ asset('storage/' . $restaurant->photo) }}"
                                    alt="{{ $restaurant->name }}">
                            @else
                                <img src="{{ asset('image/restaurant-placeholder.jpg') }}" alt="{{ $restaurant->name }}">
                            @endif
                        </div>
                    </a>
                    <div class="info_card">
                        <div class="name">
                            <a href="{{ route('admin.restaurants.show', $restaurant) }}">
                                <h3>{{ $restaurant->name }}</h3>
                            </a>
                            <p>{{ $restaurant->description }}</p>
                        </div>
                        <div class="route">
                            <a href="{{ route('admin.restaurants.edit', $restaurant) }}"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.restaurants.destroy', $restaurant) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" value="Elimina"
                                    onclick='return confirm("Sei sicuro di voler cancellare l&apos;elemento?")'><i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                        <div class="blue">
                            @if ($restaurant->sponsored == 1)
                            <i class="fas fa-medal active"></i> 
                            @endIf
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @endif
    </div>
@endsection
