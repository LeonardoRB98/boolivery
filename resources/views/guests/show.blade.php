@extends('layouts.main')

@section('content')
<span id="emilio">
    <div class="jumbo">
        @if (!is_null($restaurant->photo_jumbo))
            <img src="{{ asset('storage/'. $restaurant->photo_jumbo) }}" alt="{{ $restaurant->name }}">
        @else
            <img src="{{ asset('image/download.png') }}" alt="{{ $restaurant->name }}">
        @endif
        {{-- <img src="{{asset('storage/'. $restaurant->photo_jumbo)}}" alt="{{$restaurant->name}}"> --}}
            <div class="restaurant">
                <h1>{{$restaurant->name}}</h1>
            </div>

        </div>
    <div class="container">
        <div class="main-menu">
            <div class="cart">
                <h2>Il Tuo Ordine</h2>
                <i class="fas fa-cookie-bite"></i>
                <div class="order_plate" v-for='plate in cart'>
                    <ul>
                        <li class="plateName">@{{ plate.name }}</li>
                        <li class="plateCounter">@{{ plate.counter }} </li>
                        <li class="platePrice">@{{ plate.price*plate.counter }} €</li>
                    </ul>
                </div>
                <hr>
                <h4>Totale: <br> @{{ totalPrice }}  €</h4>
            </div>

            <section>
                <h1>I Nostri Piatti</h1>
                <plate-component
                    v-for="plate in plates"
                    :name="plate.name"
                    :id="plate.id"
                    :price="plate.price"
                    :key="plate.id">
                </plate-component>
            </section>
        </div>
    </div>
</span>
@endsection
<script>
    var id = {!! json_encode($restaurant->id) !!};
</script>
