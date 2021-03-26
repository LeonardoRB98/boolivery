@extends('layouts.main')

@section('content')
    <div class="container wrapper">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Crea Piatto</h1>
            <a class="blue-button" href="{{ route('admin.restaurants.show', [$id]) }}">Torna al ristorante</a>
        </div>
        <form action="{{ route('admin.plates.store') }}" method='POST' enctype="multipart/form-data" class="login-form">
            @method('POST')
            @csrf
            <div class="form-group">
                <label for="name">Nome Piatto</label>
                <input class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name" value={{ old('name') }}>
                @error('name')
                    <span class="error-form" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Descrizione/Ingredienti</label>
                <textarea class="form-control @error('description') is-invalid @enderror" type="text" id="description" name="description" rows="10"> {{ old('description') }} </textarea>
                @error('description')
                    <span class="error-form" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="price">Prezzo</label>
                {{-- <input type="number" step="0.01"> --}}
                <input class="form-control @error('price') is-invalid @enderror" step="0.01" type="number" id="price" name="price"> {{ old('price') }}
                @error('price')
                    <span class="error-form" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="photo">Immagine</label>
                <input class='form-control' accept="image/*" type="file" id="photo" name="photo" value={{ old('photo') }}>
            </div>
            <input type="hidden" name="id" value="{{$id}}">
            <input type="submit" value="Crea Piatto" class="blue-button">
        </form>
    </div>
@endsection
