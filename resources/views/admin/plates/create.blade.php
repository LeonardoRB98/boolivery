@extends('layouts.admin.main')
@dd($restaurant)
@section('content')


    <div class="container">

        <div class="container mb-5">
            <div class="clearfix mb-4">
                <a href="{{ route('admin.plates.index', $restaurant) }}" class="btn btn-primary float-right">Elenco Piatti</a>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <form action="{{ route('admin.plates.store', $restaurant) }}" method='POST' enctype="multipart/form-data">
            @method('POST')
            @csrf

            <div class="form-group">
                <label for="name">Nome Piatto</label>
                <input class='form-control' type="text" id="name" name="name" value={{ old('name') }}>
            </div>

            <div class="form-group">
                <label for="description">Descrizione/Ingredienti</label>
                <textarea class='form-control' type="text" id="description" name="description" rows="10"> {{ old('description') }} </textarea>
            </div>

            <div class="form-group">
                <label for="price">Prezzo</label>
                {{-- <input type="number" step="0.01"> --}}
                <input class='form-control' step="0.01" type="number" id="price" name="price"> {{ old('price') }}
            </div>


            <div class="form-group">
                <label for="photo">Immagine</label>
                <input class='form-control' accept="image/*" type="file" id="photo" name="photo" value={{ old('photo') }}>
            </div>

            <input type="submit" value="Crea">
        </form>

    </div>
@endsection
