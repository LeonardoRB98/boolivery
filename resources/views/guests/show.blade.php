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
            <img src="{{ asset('image/restaurant-placeholder.jpg') }}" alt="{{ $restaurant->name }}">
        @endif
        {{-- FLIP CARD --}}
        <div class="restaurant flip_card">
            <div class="flip_card_inner shadow">
                <div class="flip_card_front">
                  <h1>{{$restaurant->name}}</h1>
                  @if ($restaurant->sponsored == true)
                      <i class="fas fa-medal"></i>
                  @endif

                </div>
                <div class="flip_card_back">
                    <div class="photo_description">
                        @if (!is_null($restaurant->photo_jumbo))
                            <img src="{{ asset('storage/'. $restaurant->photo) }}" alt="{{ $restaurant->name }}">
                        @else
                            <img src="{{ asset('image/restaurant-placeholder.jpg') }}" alt="{{ $restaurant->name }}">
                        @endif
                    </div>
                    <div class="title_description">
                        <p>{{$restaurant->description}}</p>
                    </div>
                </div>
            </div>
        </div>
        {{-- FLIP CARD --}}
        </div>
    <div class="container-fluid">
        <div class="main-menu">
            <i v-on:click="hiddenCart = !hiddenCart" id="trigger_cart_mobile" class="fas fa-shopping-cart shadow">
                <span v-if="totalCartItems != 0" id="total_cart">@{{totalCartItems}}</span>
            </i>
            <div v-if="!hiddenCart"  class="cart shadow animate__animated animate__jello" id="desktopCartNoDeskop">
                <h2>Il Tuo Ordine</h2>
                <i class="fas fa-cookie-bite"></i>
                <div class="order_plate shadow" v-for='plate in cart'>
                    <ul>
                        <li class="plateName">@{{ plate.name }}</li>
                        <li class="plateAddRemove">
                            <i v-on:click="add(plate.id, plate.counter, plate.price, plate.name)" class="fas fa-plus-square" id="plus"></i>
                            <i v-on:click="remove(plate.id, plate.counter, plate.price, plate.name)" class="fas fa-minus-square" id="minus"></i></li>
                        <li class="plateCounter">X @{{ plate.counter }} </li>
                        <li class="platePrice">@{{ calculatePrice(plate.price, plate.counter) }} €</li>
                    </ul>
                </div>
                <span v-if="cart.length != 0">
                    <i v-on:click="trashCart" class="fas fa-trash-alt delete"></i>
                </span>
                <hr>
                <span v-if="cart.length != 0">
                    <h4>Totale: <br> @{{ formatFix(totalPrice) }}  €</h4>
                </span>
                 <span v-if="cart.length != 0">
                    <a class="to_checkout" href="{{route('checkout')}}">
                        <i class="far fa-credit-card animate__animated animate__wobble"></i>
                    </a>
                </span>
            </div>
            {{-- SECONDO CARRELLO DA NASCONDERE IN MOBILE --}}
            <div class="cart shadow animate__animated animate__jello" id="mobileCartNoMobile">
                <h2>Il Tuo Ordine</h2>
                <i class="fas fa-cookie-bite"></i><br>
                <div class="order_plate shadow" v-for='plate in cart'>
                    <ul>
                        <li class="plateName">@{{ plate.name }}</li>
                        <li class="plateAddRemove">
                            <i v-on:click="add(plate.id, plate.counter, plate.price, plate.name)" class="fas fa-plus-square" id="plus"></i>
                            <i v-on:click="remove(plate.id, plate.counter, plate.price, plate.name)" class="fas fa-minus-square" id="minus"></i></li>
                        <li class="plateCounter">X @{{ plate.counter }} </li>
                        <li class="platePrice">@{{ calculatePrice(plate.price, plate.counter) }} €</li>
                    </ul>
                </div>
                <span v-if="cart.length != 0">
                    <i v-on:click="trashCart" class="fas fa-trash-alt delete"></i>
                </span>
                <hr>
                <span v-if="cart.length != 0">
                    <h4>Totale: <br> @{{ formatFix(totalPrice) }}  €</h4>
                </span>
                <span v-if="cart.length != 0">
                    <a class="to_checkout" href="{{route('checkout')}}">
                        <i class="far fa-credit-card animate__animated animate__wobble"></i>
                    </a>
                </span>

            </div>

            <section class="plate_container">
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



