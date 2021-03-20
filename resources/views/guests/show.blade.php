@extends('layouts.main')
<head>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Bangers&display=swap" rel="stylesheet">
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
</head>
{{-- @dd($restaurant->plates) --}}
@section('content')
<span id="emilio">
    <div class="jumbo">
        @if (!is_null($restaurant->photo_jumbo))
            <img src="{{ asset('storage/'. $restaurant->photo_jumbo) }}" alt="{{ $restaurant->name }}">
        @else
            <img src="{{ asset('image/download.png') }}" alt="{{ $restaurant->name }}">
        @endif
            <div class="restaurant shadow">
                <h1>{{$restaurant->name}}</h1>
            </div>

        </div>
    <div class="container">
        <div class="main-menu">
            <i v-on:click="hiddenCart = !hiddenCart" id="trigger_cart_mobile" class="fas fa-shopping-cart shadow"></i>
            <div v-if="!hiddenCart"  class="cart shadow animate__animated animate__jello" id="desktopCartNoDeskop">
                <h2>Il Tuo Ordine</h2>
                <i class="fas fa-cookie-bite"></i>
                <div class="order_plate" v-for='plate in cart'>
                    <ul>
                        <li class="plateName">@{{ plate.name }}</li>
                        <li class="plateCounter">X @{{ plate.counter }} </li>
                        <li class="platePrice">@{{ plate.price*plate.counter }} €</li>
                    </ul>
                </div>
                <hr>
                <h4>Totale: <br> @{{ totalPrice }}  €</h4>
                {{-- SE LOCAL STORAGE è PIENO STAMPA LINK CHECKOUT --}}

                    <a class="to_checkout" href="{{route('checkout')}}">
                        <i class="far fa-credit-card"></i>
                    </a>

            </div>
            {{-- SECONDO CARRELLO DA NASCONDERE IN MOBILE --}}
            <div class="cart shadow animate__animated animate__jello" id="mobileCartNoMobile">
                <h2>Il Tuo Ordine</h2>
                <i class="fas fa-cookie-bite"></i>
                <div class="order_plate" v-for='plate in cart'>
                    <ul>
                        <li class="plateName">@{{ plate.name }}</li>
                        <li class="plateCounter">X @{{ plate.counter }} </li>
                        <li class="platePrice">@{{ plate.price*plate.counter }} €</li>
                    </ul>
                </div>
                <hr>
                <h4>Totale: <br> @{{ totalPrice }}  €</h4>
                {{-- SE LOCAL STORAGE è PIENO STAMPA LINK CHECKOUT --}}
                <a class="to_checkout" href="{{route('checkout')}}">
                    <i class="far fa-credit-card"></i>
                </a>
            </div>

            <section>
                <h2 id="text_plate">I Nostri Piatti</h2>
                <plate-component
                    v-for="plate in plates"
                    :name="plate.name"
                    :description="plate.description"
                    :photo="plate.photo"
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
