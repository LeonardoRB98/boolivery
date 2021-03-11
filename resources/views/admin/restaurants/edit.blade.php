@extends('layouts.admin.main')

@section('content')

<div class="container">

    <div class="container mb-5">
        <div class="clearfix mb-4">
            <a href="{{ route('admin.restaurants.index') }}" class="btn btn-primary float-right">Elenco Ristoranti</a>
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

    <form action="{{ route('admin.restaurants.store') }}" method='POST' enctype="multipart/form-data">
        @method('POST')
        @csrf
    
        <div class="form-group">
            <label for="name">Nome Ristorante</label>
            <input class='form-control' type="text" id="name" name="name" value={{ $restaurant->name }}>
        </div>
    
        <div class="form-group">
            <label for="email">Email</label>
            <input class='form-control' type="text" id="email" name="email" value={{ $restaurant->email }}>
        </div>
    
        <div class="form-group">
            <label for="address">Indirizzo</label>
            <input class='form-control' type="text" id="address" name="address" value={{ $restaurant->address }}>
        </div>
    
        <div class="form-group">
            <label for="phone">Numero di telefono</label>
            <input class='form-control' type="text" id="phone" name="phone" value={{ $restaurant->phone }}>
        </div>

        <div class="form-group">
            <label for="p_iva">P. IVA</label>
            <input class='form-control' type="text" id="p_iva" name="p_iva" value={{ $restaurant->p_iva }}>
        </div>
    
        <div class="form-group">
            <label for="description">Descrizione</label>
            <textarea class='form-control' type="text" id="description" name="description" rows="10"> {{ $restaurant->description }} </textarea>
        </div>
    
        <div class="form-group">
            <label for="photo">Immagine</label>
            <input class='form-control' accept="image/*" type="file" id="photo" name="photo"  value="{{ old('photo')}}">
            <img class="image-fluid" style="width: 200px" src="{{ asset('storage/' . $restaurant->photo) }}" alt="" >
        </div>
    
        <div class="form-group">
            <label for="photo_jumbo">Immagine background</label>
            <input class='form-control' accept="image/*" type="file" id="photo_jumbo" name="photo_jumbo" value="{{ old('photo_jumbo')}}" >
            <img class="image-fluid" style="width: 200px" src="{{ asset('storage/' . $restaurant->photo_jumbo) }}" alt="">
        </div>
        <div class="form-group">
            <label for="categories">Categorie</label>
            <select class="js-select_categories form-control" name="categories[]" multiple="multiple">
                
                @foreach ($categories as $category)
                    <option value="{{$category->id}}"
                        @if ($restaurant->categories->contains($category->id))
                        checked 
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
        
    
        <input type="submit" value="Crea">
     </form>

</div>
   

    
@endsection