@extends('layouts.main')
{{-- @dd($restaurant) --}}
@section('content')

<div class="container wrapper">
    <div class="d-flex justify-content-between align-items-center">
        <h1>Modifica Ristorante</h1>
        <a class="blue-button" href="{{ route('admin.restaurants.index') }}">Torna ai ristoranti</a>
    </div>

    <form action="{{ route('admin.restaurants.update', $restaurant) }}" method='POST' enctype="multipart/form-data" class="login-form">
        @method('PUT')
        @csrf

        <div class="form-group">
            <label for="name">Nome Ristorante</label>
            <input class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name" value="{{$restaurant->name}}">
            @error('name')
                <span class="error-form" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control @error('email') is-invalid @enderror" type="email" id="email" name="email" value="{{ $restaurant->email }}">
            @error('email')
                <span class="error-form" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="address">Indirizzo</label>
            <input class="form-control @error('address') is-invalid @enderror" type="text" id="address" name="address" value="{{ $restaurant->address }}">
            @error('address')
                <span class="error-form" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="phone">Numero di telefono</label>
            <input class="form-control @error('phone') is-invalid @enderror" type="text" id="phone" name="phone" value={{ $restaurant->phone }}>
            @error('phone')
                <span class="error-form" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="p_iva">P. IVA</label>
            <input class="form-control @error('p_iva') is-invalid @enderror" type="text" id="p_iva" name="p_iva" value="{{ $restaurant->p_iva }}">
            @error('p_iva')
                <span class="error-form" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Descrizione</label>
            <textarea class="form-control @error('description') is-invalid @enderror" type="text" id="description" name="description" rows="10"> {{ $restaurant->description }} </textarea>
            @error('description')
                <span class="error-form" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="photo">Immagine</label>
            <input class="form-control @error('photo') is-invalid @enderror" accept="image/*" type="file" id="photo" name="photo"  value="{{ old('photo')}}">
            <img class="image-fluid" style="width: 200px" src="{{ asset('storage/' . $restaurant->photo) }}" alt="" >
            @error('photo')
                <span class="error-form" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="photo_jumbo">Immagine background</label>
            <input class="form-control @error('photo_jumbo') is-invalid @enderror" accept="image/*" type="file" id="photo_jumbo" name="photo_jumbo" value="{{ old('photo_jumbo')}}">
            <img class="image-fluid" style="width: 200px" src="{{ asset('storage/' . $restaurant->photo_jumbo) }}" alt="">
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
                    <option value="{{$category->id}}"
                        @if ($restaurant->categories->contains($category->id))
                        selected
                        @endif>
                        {{ $category->category }}
                    </option>
                @endforeach

              </select>
        </div>

        <fieldset class="form-group">
            <div class="row">
              <legend class="col-form-label col-sm-2 pt-0">Sponsorizzazione</legend>
              <div class="col-sm-10">
                <div class="form-check">
                    @if($restaurant->sponsored)
                      <input class="form-check-input" type="radio" name="sponsored" id="sponsored" value="true" checked>
                    @else 
                      <input class="form-check-input" type="radio" name="sponsored" id="sponsored" value="true">
                    @endif
                  <label class="form-check-label" for="sponsored">
                    Si
                  </label>
                </div>
                <div class="form-check">
                    @if($restaurant->sponsored == "false")
                      <input class="form-check-input" type="radio" name="sponsored" id="sponsored" value="false" checked>
                    @else 
                      <input class="form-check-input" type="radio" name="sponsored" id="sponsored" value="false">
                    @endif 
                    <label class="form-check-label" for="sponsored">
                      No
                    </label>
                  </div>
            </div>
      </fieldset>


        <input type="submit" value="Modifica" class="blue-button">
     </form>

</div>



@endsection
