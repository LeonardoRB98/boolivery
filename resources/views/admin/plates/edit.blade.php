@extends('layouts.admin.main')

@section('content')
    <div class="container">

            <div class="container mb-5">
                <div class="clearfix mb-4">
                    <a href="{{route('admin.restaurants.show', [$plate->restaurant_id]) }}" class="btn btn-primary float-right">Elenco Piatti</a>
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

            <form action="{{ route('admin.plates.update', $plate) }}" method='POST' enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <div class="form-group">
                    <label for="name">Nome Piatto</label>
                    <input class='form-control' type="text" id="name" name="name" value={{ $plate->name }}>
                </div>

                <div class="form-group">
                    <label for="description">Descrizione/Ingredienti</label>
                    <textarea class='form-control' type="text" id="description" name="description" rows="10"> {{ $plate->description }} </textarea>
                </div>

                <div class="form-group">
                    <label for="price">Prezzo</label>
                    <input class='form-control' step="0.01" type="number" id="price" name="price" value= {{$plate->price}}>
                </div>


                <div class="form-group">
                    <label for="photo">Immagine</label>
                    <input class='form-control' accept="image/*" type="file" id="photo" name="photo" value={{ $plate->photo }}>
                </div>



                <input type="submit" value="Modifica Piatto">
            </form>

        </div>
@endsection
