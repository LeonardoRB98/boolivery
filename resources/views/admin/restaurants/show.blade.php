@extends('layouts.admin.main')

@section('content')

 <div class="container text-center">
     <h1>{{$restaurant->name}}</h1>
     @if (!is_null($restaurant->photo))
        <img style="width: 200px" class="img-fluid" src="{{ asset('storage/'. $restaurant->photo) }}" alt="{{ $restaurant->name }}">
     @else
        <img style="width: 200px" class="img-fluid" src="{{ asset('image/download.png') }}" alt="{{ $restaurant->name }}">
    @endif
    @if (!is_null($restaurant->photo_jumbo))
        <img style="width: 200px" class="img-fluid" src="{{ asset('storage/'. $restaurant->photo_jumbo) }}" alt="{{ $restaurant->name }}">
    @else
        <img style="width: 200px" class="img-fluid" src="{{ asset('image/download.png') }}" alt="{{ $restaurant->name }}">
    @endif
    <h3>{{$restaurant->address}}</h3>
    <h3>{{$restaurant->email}}</h3>
    <h3>{{$restaurant->p_iva}}</h3>
    <h3>{{$restaurant->phone}}</h3>
    <h3> Sponsorizzazione:  {{ $restaurant->sponsored ? 'sponsored' : 'no' }}</h3>
    <ul>
        @foreach ($restaurant->categories as $category)
            <li>{{$category->category}}</li>
        @endforeach
    </ul>
    <a href="{{route("admin.plates.showPlates", ['restaurant_id' => $restaurant->id])}}">I TUOI PIATTI</a>

 </div>

@endsection
