@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Modifica Piatto</h1>
            <a class="blue-button" href="{{ route('admin.restaurants.show', [$plate->restaurant_id]) }}">Torna al ristorante</a>
        </div>
        <form action="{{ route('admin.plates.update', $plate) }}" method='POST' enctype="multipart/form-data" class="login-form">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="name">Nome Piatto</label>
                <input class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name" value="{{ $plate->name }}">
                @error('name')
                    <span class="error-form" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Descrizione/Ingredienti</label>
                <textarea class="form-control @error('description') is-invalid @enderror" type="text" id="description" name="description" rows="10"> {{ $plate->description }} </textarea>
                @error('description')
                    <span class="error-form" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="price">Prezzo</label>
                <input class="form-control @error('price') is-invalid @enderror" step="0.01" type="number" id="price" name="price" value= "{{$plate->price}}">
                @error('price')
                    <span class="error-form" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="photo">Immagine</label>
                <input class="form-control @error('photo') is-invalid @enderror" accept="image/*" type="file" id="photo" name="photo" value="{{ $plate->photo }}">
                <img class="image-fluid" style="width: 200px" src="{{ asset('storage/' . $plate->photo) }}" alt="" >
                @error('photo')
                    <span class="error-form" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <input type="submit" value="Modifica Piatto" class="blue-button">
        </form>
    </div>
@endsection
