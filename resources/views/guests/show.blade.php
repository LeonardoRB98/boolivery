@extends('layouts.guests.main')

@section('content')
<div class="jumbo">
    <div class="restaurant">
        <h1>Nome ristorante</h1>
    </div>

</div>
<div class="main-menu">
    <section>
        <div v-for="(plate, index) in plates" class="card">
            <div class="card-body">
                <div v-show="plate.counter != 0 "><span v-on:click="decreaseCounter(index)">Rimuovi</span></div>
                <span style='visibility:hidden'><input v-model="counter"></span>
                <div><span v-on:click="increaseCounter(index)">Aggiungi</span></div>
            </div>
        </div>

    </section>
    <div class="chart">
        <h1 v-on:click="getRestaurantPlates(1)">Carrello</h1>
        <h2 v-for="plate in plates">@{{plate.name}}<input v-model="plate.counter" type="number" id="tentacles" name="tentacles" min="0" max="100"></h2>
    </div>
</div>

@endsection
