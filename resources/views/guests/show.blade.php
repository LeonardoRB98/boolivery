@extends('layouts.guests.main')

@section('content')
<div class="jumbo">
    <div class="restaurant">
        <h1>Nome ristorante</h1>
    </div>

</div>
<div class="main-menu">
    <section>

        <div v-for="plate in plates">
            <plate-component v-bind:name="plate.name"></plate-component> 
        </div>

    </section>
    <div class="chart">
       <cart-component></cart-component>
    </div>
</div>

@endsection
