@extends('layouts.main')
@section('content')


    <div class="container wrapper">

        <div class="clearfix mb-4 col-sm-12">
            <h1 class="col-sm-4 col-xs-12">Crea Piatto</h1>
            <a href="{{ route('admin.restaurants.show', [$id]) }}" class="btn btn-primary float-right">Elenco Piatti</a>
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


        <form action="{{ route('admin.plates.store') }}" method='POST' enctype="multipart/form-data" class="login-form">
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

            <input type="hidden" name="id" value="{{$id}}">

            <input type="submit" value="Crea Piatto" class="btn btn_darkBlue">
        </form>

    </div>
@endsection
