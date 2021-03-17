@extends('layouts.guests.main')

@section('content')
<div class="jumbo">
    <div class="restaurant">
        <h1>Nome ristorante</h1>
        
    </div>

</div>
<button v-on:click='getRestaurantPlates(3)'>Click</button>
<div class="main-menu">
    
    <section>
        <h1>I piatti</h1>
        <plate-component 
            v-for="plate in plates"
            :name="plate.name"
            :id="plate.id"
            :price="plate.price"
            :key="plate.id">
        </plate-component>
    </section>
</div>

@endsection
