@extends('layouts.main')

@section('content')

<div class="container wrapper">
    <div class="d-flex justify-content-between align-items-center">
        <h1>Crea Ristorante</h1>
        <a class="blue-button" href="{{ route('admin.restaurants.index') }}">
            <span>Elenco Ristoranti</span>
        </a>
    </div>

    <form action="{{ route('admin.restaurants.store') }}" method='POST' enctype="multipart/form-data" class="login-form">
        @method('POST')
        @csrf

        <div class="form-group">
            <label for="name">Nome Ristorante</label>
            <input class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name" value={{ old('name') }}>
            @error('name')
                <span class="error-form" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control @error('email') is-invalid @enderror" type="email" id="email" name="email" value={{ old('email') }}>
            @error('email')
                <span class="error-form" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="address">Indirizzo</label>
            <input class="form-control @error('address') is-invalid @enderror" type="text" id="address" name="address" value={{ old('address') }}>
            @error('address')
                <span class="error-form" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            
        </div>

        <div class="form-group">
            <label for="phone">Numero di telefono</label>
            <input class="form-control @error('phone') is-invalid @enderror" type="text" id="phone" name="phone" value={{ old('phone') }}>
            @error('phone')
                <span class="error-form" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="p_iva">P. IVA</label>
            <input class="form-control @error('p_iva') is-invalid @enderror" type="text" id="p_iva" name="p_iva" value={{ old('p_iva') }}>
            @error('p_iva')
                <span class="error-form" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Descrizione</label>
            <textarea class="form-control @error('description') is-invalid @enderror" type="text" id="description" name="description" rows="10"> {{ old('description') }} </textarea>
            @error('description')
                <span class="error-form" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="photo">Immagine</label>
            <input class="form-control @error('photo') is-invalid @enderror" accept="image/*" type="file" id="photo" name="photo" value={{ old('photo') }}>
            @error('photo')
                <span class="error-form" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="photo_jumbo">Immagine background</label>
            <input class="form-control @error('photo_jumbo') is-invalid @enderror" accept="image/*" type="file" id="photo_jumbo" name="photo_jumbo" value={{ old('photo_jumbo') }}>
            @error('photo_jumbo')
                <span class="error-form" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="categories">Categorie</label>
            <select class="js-select_categories form-control" name="categories[]" multiple="multiple">
                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{ $category->category }}</option>
                @endforeach
              </select>
        </div>

        <fieldset class="form-group">
            <div class="row">
              <legend class="col-form-label col-sm-4 pt-0">Sponsorizzazione</legend>
              <div class="col-sm-10">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="sponsored" id="sponsored" value="true" checked>
                  <label class="form-check-label" for="sponsored">
                    Si
                  </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="sponsored" id="sponsored" value="false" checked>
                    <label class="form-check-label" for="sponsored">
                      No
                    </label>
                </div>
            </div>
        </div>
      </fieldset>


        <input type="submit" value="Crea" class="blue-btn">
     </form>

</div>



@endsection
